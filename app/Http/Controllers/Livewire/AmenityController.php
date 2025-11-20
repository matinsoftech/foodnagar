<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Amenity;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmenityController extends Controller
{
    public function index(){
        $amenities = Amenity::with('vendorType')->paginate(10);
        return view('livewire.amenities.index',compact('amenities'));
    }
    public function create(){
        $moduleConfig = AppModule::first(); // Retrieve the first AppModule configuration

        if ($moduleConfig && $moduleConfig->module_type == 'single') {
            // Fetch vendor types filtered by the selected module type
            $vendorTypes = VendorType::active()
                ->where('id', $moduleConfig->vendor_types_id)
                ->get();
        } else {
            // Fetch all active vendor types if no specific module type is configured
            $vendorTypes = VendorType::active()->get();
        }
        // $vendorTypes = VendorType::where('is_active',1)->get();
        return view('livewire.amenities.create',compact('vendorTypes'));
    }

    public function store(Request $request){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:brands|max:255',
            'image' => 'nullable|image|max:2048',
            'vendor_type_id' => 'required|exists:vendor_types,id'
        ]);

        $amenity = Amenity::create([
            'name' => $validatedData['name'],
            'is_active' => $request->is_published  ? 1 : 0,
            'vendor_type_id' => $request->vendor_type_id
        ]);

        // Handle image upload using Spatie Media Library
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image and associate it with the brand post in the 'images' media collection
            $amenity->addMedia($image)
                ->toMediaCollection('images');
        }

        // Redirect or send a success message
        return redirect()->route('amenities.index')->with('success', 'Amenity created successfully!');
    }

    public function show($id){
        $amenity = Amenity::with('module')->find($id);

        return view('livewire.amenities.show',compact('amenity'));
    }

    public function edit($id){
        $amenity = Amenity::find($id);
        $moduleConfig = AppModule::first(); // Retrieve the first AppModule configuration

        if ($moduleConfig && $moduleConfig->module_type == 'single') {
            // Fetch vendor types filtered by the selected module type
            $vendorTypes = VendorType::active()
                ->where('id', $moduleConfig->vendor_types_id)
                ->get();
        } else {
            // Fetch all active vendor types if no specific module type is configured
            $vendorTypes = VendorType::active()->get();
        }
        return view('livewire.amenities.edit',compact('amenity','vendorTypes'));
    }

    public function update(Request $request,$id)
    {
       // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'image' => 'nullable|image|max:2048',
            'vendor_type_id' => 'required|exists:vendor_types,id'
        ]);

        // Find the blog and update
        $amenity = Amenity::findOrFail($id);
        $amenity->update([
            'name' => $validatedData['name'],
            'is_active' => $request->is_published  ? 1 : 0,
            'vendor_type_id' => $request->vendor_type_id
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Clear the old images from the media collection
            $amenity->clearMediaCollection('images');  // This removes all images in the 'images' collection

            // Add the new image to the media collection
            $amenity->addMedia($request->file('image'))->toMediaCollection('images');
        }
        // Redirect with success message
        return redirect()->route('amenities.index')->with('success', 'Amenity updated successfully!');
    }

    public function destroy($id){
        $amenity = Amenity::findOrFail($id);
        $amenity->delete();
        return redirect()->back()->with('success', 'Amenity Deleted successfully!');
    }
}
