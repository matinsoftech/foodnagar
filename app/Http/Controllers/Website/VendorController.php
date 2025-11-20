<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorType;

class VendorController extends Controller
{
    public function vendorList()
    {
        $vendors = Vendor::with('vendor_type')->get();
        return view('livewire.website.partials.vendors',compact('vendors'));
    }


    public function shopDetail($id)
    {
        $vendor = Vendor::with('vendor_type','categories')->where('id', $id)->firstOrFail();
        $vendorType = VendorType::where('id', $vendor->vendor_type_id)->first();
        $categories = $vendor->categories;
        $products = $vendor->products;
        return view('livewire.website.partials.shopView',compact('vendor','categories','vendorType','products'));
    }
}
