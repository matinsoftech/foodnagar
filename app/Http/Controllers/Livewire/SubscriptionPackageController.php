<?php

namespace App\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Models\AppModule;
use App\Models\SubscriptionPurchase;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SubscriptionPackageController extends Controller
{
    public function index()
    {
        $packages = SubscriptionPackage::latest()->paginate(10);
        return view('livewire.subscription.index', compact('packages'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $moduleConfig = AppModule::first(); // Retrieve the first AppModule configuration

        if ($moduleConfig && $moduleConfig->module_type == 'single') {
            // Fetch vendor types filtered by the selected module type
            $vendortypes = VendorType::active()
                ->where('id', $moduleConfig->vendor_types_id)
                ->get();
        } else {
            // Fetch all active vendor types if no specific module type is configured
            $vendortypes = VendorType::active()->get();
        }
        return view('livewire.subscription.create', compact('vendortypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_type_id' => 'required|array', // must be an array
            'vendor_type_id.*' => 'exists:vendor_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_free' => 'nullable|boolean',
            'amount' => 'nullable|numeric',
            'days' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        // $data['vendor_type_id'] = json_encode($request->vendor_type_id);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('subscription_photos', 'public');
        }

        SubscriptionPackage::create($data);

        return redirect()->route('subscription.index')->with('success', 'Package created successfully.');
    }

    public function edit(SubscriptionPackage $subscription)
    {
        $vendorTypes = VendorType::all();
        // $subscription->vendor_type_id = $subscription->vendor_type_id ? json_decode($subscription->vendor_type_id, true) : [];

        return view('livewire.subscription.edit', [
            'package' => $subscription,
            'vendorTypes' => $vendorTypes,
        ]);
    }

    public function update(Request $request, SubscriptionPackage $subscription)
    {
        $validated = $request->validate([
            'vendor_type_id' => 'required|array', // must be an array
            'vendor_type_id.*' => 'exists:vendor_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_free' => 'nullable|boolean',
            'amount' => 'nullable|numeric',
            'days' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('packages', 'public');
        }

        $subscription->update($validated);
        return redirect()->route('subscription.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(SubscriptionPackage $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscription.index')->with('success', 'Package deleted successfully.');
    }

    public function purchaseIndex()
    {
        $purchases = SubscriptionPurchase::with(['user', 'package'])
            ->latest()
            ->paginate(15);

        return view('livewire.subscription.purchase', compact('purchases'));
    }

    public function updatePurchaseStatus(Request $request, SubscriptionPurchase $purchase)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        $purchase->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Purchase status updated successfully.');
    }
}
