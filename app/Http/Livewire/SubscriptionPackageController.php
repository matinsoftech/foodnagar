<?php

namespace App\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use App\Models\Vendor;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class SubscriptionPackageController extends Controller
{
    public function index() {
        $packages = SubscriptionPackage::with('vendor')->get();
        return view('subscription.index', compact('packages'));
    }

    public function create() {
        $vendors = Vendor::all();
        return view('subscription.create', compact('vendors'));
    }

    public function store(Request $request) {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_free' => 'required|boolean',
            'amount' => 'nullable|numeric',
            'days' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('subscription_photos', 'public');
        }

        SubscriptionPackage::create($data);

        return redirect()->route('subscription.index')->with('success', 'Package created successfully.');
    }
}
