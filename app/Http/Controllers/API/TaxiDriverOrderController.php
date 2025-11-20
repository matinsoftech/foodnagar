<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TaxiOrder;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\DeliveryAddress;
use App\Models\VehicleType;
use App\Models\PaymentMethod;
use App\Models\TaxiZone;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Vehicle;
use App\Models\WalletTransaction;
use App\Services\DriverAssignmentCheckService;
use App\Traits\FirebaseAuthTrait;
use App\Traits\GoogleMapApiTrait;
use App\Traits\TaxiTrait;
use App\Traits\OrderTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TaxiDriverOrderController extends Controller
{
    use GoogleMapApiTrait, TaxiTrait, OrderTrait;
    use FirebaseAuthTrait;
    //
    public function driverRejectAssignment(Request $request)
    {
        //
        try {
            //
            $order = Order::find($request->order_id);
            $orderRef = "newTaxiOrders/" . $order->code . "";
            //
            $firestoreClient = $this->getFirebaseStoreClient();
            $orderDocument = $firestoreClient->getDocument($orderRef);
            $ignoredDrivers = $orderDocument->getArray("ignoredDrivers") ?? [];
            array_push($ignoredDrivers, \Auth::id());
            //
            $firestoreClient->updateDocument(
                $orderRef,
                [
                    "ignoredDrivers" => $ignoredDrivers
                ],
            );

            //
            return response()->json([
                "message" => __("Driver reject order successul"),
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage() ?? __("Driver reject order failed"),
            ], 400);
        }
    }

    public function driverAcceptAssignment(Request $request)
    {
        Log::info("Driver accept assignment payload => " . json_encode($request->all()));
        $driver = User::find(Auth::id());

        try {
            // Set transaction isolation level to SERIALIZABLE
            DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
            DB::beginTransaction();

            // Lock the order row to ensure no concurrent updates
            $order = Order::where('id', $request->order_id)
                ->lockForUpdate()
                ->first();

            if (empty($order)) {
                throw new Exception(__("Order could not be found"));
            }

            // Check if the order has already been assigned to another driver
            if (!empty($order->driver_id)) {
                throw new Exception(__("Order has been accepted already by another driver"));
            }

            // Perform driver assignment checks
            (new DriverAssignmentCheckService())->checkCanAssignOrder($order);

            if (in_array($order->status, ["cancelled", "delivered", "failed"])) {
                throw new Exception(__("Order has already been") . " " . $order->status);
            }

            // Check if the driver has any uncompleted orders
            $uncompletedOrder = Order::where("driver_id", $driver->id)
                ->otherCurrentStatus('failed', 'cancelled', 'delivered', 'completed')
                ->first();

            if ($order->taxi_order != null && !empty($uncompletedOrder)) {
                throw new Exception(__("You have an uncompleted order"));
            }

            $maxOnOrderForDriver = maxDriverOrderAtOnce($order);
            if ((int)$maxOnOrderForDriver <= $driver->assigned_orders) {
                throw new Exception(__("You have reached the maximum number of orders you can accept at once"));
            }

            // Assign driver to order
            $order->driver_id = $driver->id;
            $order->save();

            // Set the order status to preparing
            $order->setStatus($request->status ?? 'preparing');

            DB::commit();
            $order->refresh();

            return response()->json([
                "message" => __("Order accepted and assigned"),
                "order" => Order::fullData()->where("id", $order->id)->first(),
            ], 200);
        } catch (\Exception $ex) {
            logger("Driver acceptance order error", [$ex]);
            DB::rollback();
            return response()->json([
                "message" => $ex->getMessage()
            ], 400);
        }
    }


    public function recordWalletDebit($wallet, $amount)
    {
        $walletTransaction = new WalletTransaction();
        $walletTransaction->wallet_id = $wallet->id;
        $walletTransaction->amount = $amount;
        $walletTransaction->reason = __("New Order");
        $walletTransaction->status = "successful";
        $walletTransaction->is_credit = 0;
        $walletTransaction->save();
    }
}
