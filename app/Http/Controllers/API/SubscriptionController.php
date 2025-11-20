<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPurchase;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\SubscriptionPackage;

class SubscriptionController extends Controller
{
    public function getSubscriptionPackages()
    {
        $packages = SubscriptionPackage::latest()->get();

        $response = $packages->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'description' => $package->description,
                'is_free' => $package->is_free,
                'amount' => $package->amount,
                'days' => $package->days,
                'status' => $package->status,
                'photo' => $package->photo ? asset('storage/' . $package->photo) : null,
                'vendor_types' => $package->vendor_types, // from accessor
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    // Purchase subscription
    public function purchase(Request $request, SubscriptionPackage $package)
    {
        $user = $request->user();

        // Check if already purchased
        $existing = SubscriptionPurchase::where('user_id', $user->id)
            ->where('subscription_package_id', $package->id)
            ->first();

        if ($existing) {
            return response()->json(['success' => false, 'message' => 'Already purchased'], 400);
        }

        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays($package->days);

        if ($package->is_free) {
            // Auto-completed for free packages
            $purchase = SubscriptionPurchase::create([
                'user_id' => $user->id,
                'subscription_package_id' => $package->id,
                'amount' => 0,
                'status' => 'completed',
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            return response()->json(['success' => true, 'message' => 'Package purchased successfully', 'data' => $purchase]);
        } else {
            // Paid package: validate receipt upload
            $request->validate([
                'payment_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $path = $request->file('payment_receipt')->store('payment_receipts', 'public');

            $purchase = SubscriptionPurchase::create([
                'user_id' => $user->id,
                'subscription_package_id' => $package->id,
                'amount' => $package->amount,
                'status' => 'pending',
                'payment_receipt' => $path,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment receipt uploaded. Waiting for verification.',
                'data' => $purchase
            ]);
        }
    }
}
