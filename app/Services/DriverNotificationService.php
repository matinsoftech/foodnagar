<?php


namespace App\Services;

use App\Models\User;
use App\Models\TaxiOrder;
use App\Models\UserToken;
use App\Models\AutoAssignment;
use App\Models\TaxiZone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\FirebaseMessagingTrait;
use Carbon\Carbon;

class DriverNotificationService
{
    use FirebaseMessagingTrait;

    public function sendNotificationToDrivers($order)
    {
        $taxiOrder = TaxiOrder::where('order_id', $order->id)
            ->first();
        // Step 1: Retrieve the list of active and online drivers with a vendor_id
        $drivers = User::where('is_active', 1)
            ->where('is_online', 1)
            ->where('available', 1)
            ->get();

        Log::info("Drivers: " . json_encode($drivers));

        // Check if drivers are found
        if ($drivers->isEmpty()) {
            Log::info("Drivers not found.");
            return;
        }

        $driverIds = [];
        $pointZone = null;
        $taxiZones = TaxiZone::with('points')->get();
        foreach ($taxiZones as $taxiZone) {
            $polygon = $taxiZone->points->map(function ($item) {
                return ['lat' => $item->lat, 'lng' => $item->lng];
            })->toArray();
        
            // Check if order user is in this zone
            if ($this->isPointInPolygon($polygon, ['lat' => $taxiOrder->pickup_latitude, 'lng' => $taxiOrder->pickup_longitude])) {
                $pointZone = $taxiZone;
                break; 
            }
        }

        Log::info("Point Zone: " . json_encode($pointZone));

        if ($pointZone) {
            $driverFoundInZone = false;

            foreach ($drivers as $driver) {
                $point = ['lat' => $driver->latitude, 'lng' => $driver->longitude];

                // Check if the driver is within the order user's zone
                if ($this->isPointInPolygon($polygon, $point)) {
                    if (!$driverFoundInZone) {
                        // Log or set the zone when the first driver is found in this zone
                        Log::info('Driver found in zone: ' . $pointZone->id);
                        $driverFoundInZone = true;
                    }
                    // Append driver ID to the array
                    $driverIds[] = $driver->id;
                }
            }

            // If drivers were found in the zone
            if ($driverFoundInZone) {
                // Continue with any further logic you need, e.g., assign the order to the drivers
                Log::info('Driver IDs: ' . implode(', ', $driverIds));
            } else {
                Log::info('No drivers found in the zone');
            }
        } else {
            Log::info('Driver not found in any zone');
            return; // Stop further execution of the function
        }

        // Step 3: Retrieve tokens from the user_tokens table
        $tokens = UserToken::whereIn('user_id', $driverIds)
            ->pluck('token')
            ->toArray();

        if (empty($tokens)) {
            Log::info("Tokens not found.");
            return;
        }

        // Step 4: Prepare notification data
        $title = "New Order Alert";
        $body = "You have a new order. Order ID: {$order->id}";
        $data = [
            'order_id' => $order->id,
            'order_type' => 'taxi_order',
        ];

        // Step 5: Send the notification
        $this->sendOrderFirebaseNotification(null, $title, $body, $data, $tokens);

        foreach ($drivers as $driver) {
            // Skip if there's already a pending or rejected assignment for this driver
            $existingAssignment = AutoAssignment::where([
                'driver_id' => $driver->id,
                'order_id' => $order->id,
            ])->first();

            if ($existingAssignment) {
                continue;
            }

            try {

                // Create new AutoAssignment
                $autoAssignment = new AutoAssignment();
                $autoAssignment->order_id = $order->id;
                $autoAssignment->driver_id = $driver->id;
                $autoAssignment->status = 'pending'; // Mark as pending until accepted
                $autoAssignment->save();

                // Prepare data for Firestore
                $pickupLat = $taxiOrder->pickup_latitude;
                $pickupLng = $taxiOrder->pickup_longitude;
                $dropoffLat = $taxiOrder->dropoff_latitude;
                $dropoffLng = $taxiOrder->dropoff_longitude;

                // Calculate distances
                $pickupDistance = $this->calculateDistance(
                    $pickupLat, $pickupLng, $driver->latitude, $driver->longitude
                );
                $tripDistance = $this->calculateDistance(
                    $pickupLat, $pickupLng, $dropoffLat, $dropoffLng
                );

                // Prepare order data
                $newOrderData = [
                    'order_id' => $order->id,
                    'pickup' => [
                        'lat' => $pickupLat,
                        'lng' => $pickupLng,
                        'address' => $taxiOrder->pickup_address,
                        'distance' => number_format($pickupDistance, 2),
                    ],
                    'dropoff' => [
                        'lat' => $dropoffLat,
                        'lng' => $dropoffLng,
                        'address' => $taxiOrder->dropoff_address,
                        'distance' => number_format($tripDistance, 2),
                    ],
                    'status' => $order->status,
                    'amount' => (string)$order->total,
                    'total' => (string)$order->total,
                    'vehicle_type_id' => $taxiOrder->vehicle_type_id,
                    'code' => $order->code,
                    'pickup_distance' => $pickupDistance,
                    'trip_distance' => $tripDistance,
                    'expires_at' => Carbon::now()->addMinutes(15)->timestamp, // Example expiration time
                ];

                Log::info('taxi order data: ' . json_encode($newOrderData));

                // Store the new order in Firestore for this driver
                $autoAssignmentService = new AutoAssignmentService();
                $autoAssignmentService->saveNewOrderToFirebaseFirestore($driver, $newOrderData);
            } catch (\Exception $ex) {
                Log::error("Error assigning order to driver: " . $ex->getMessage());
            }
        }
    }

    private function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371; // Earth radius in kilometers

        // Convert degrees to radians
        $latFrom = deg2rad($latitude1);
        $lonFrom = deg2rad($longitude1);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);

        // Calculate the differences between latitudes and longitudes
        $latDiff = $latTo - $latFrom;
        $lonDiff = $lonTo - $lonFrom;

        // Apply Haversine formula
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calculate the distance
        $distance = $earthRadius * $c;

        return $distance; // Distance in kilometers
    }

    public function isPointInPolygon(array $polygon, array $point): bool
    {
        $x = $point['lng'];
        $y = $point['lat'];

        $inside = false;
        $numPoints = count($polygon);
        $j = $numPoints - 1;

        for ($i = 0; $i < $numPoints; $i++) {
            $xi = $polygon[$i]['lng'];
            $yi = $polygon[$i]['lat'];
            $xj = $polygon[$j]['lng'];
            $yj = $polygon[$j]['lat'];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                        ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) {
                $inside = !$inside;
            }
            $j = $i;
        }

        return $inside;
    }

}
