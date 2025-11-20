<?php

namespace App\Http\Controllers\Livewire;

use App\Models\AppModule;
use App\Models\VendorType;
use App\Models\CustomField;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomFieldController extends Controller
{
    public function index(){
        $customFields = CustomField::with('vendorType')->paginate(10);
        return view('livewire.customfields.index',compact('customFields'));
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
        return view('livewire.customfields.create',compact('vendorTypes'));
    }

    public function store(Request $request){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name'       => 'required',
            'type'       => 'required|in:number,textbox,fileinput,radio,dropdown,checkbox',
            'image'      => 'nullable',
            'required'   => 'required',
            'is_active'  => 'nullable',
            'values'     => 'required_if:type,radio,dropdown,checkbox|array',
            'min_length' => 'required_if:number,textbox',
            'max_length' => 'required_if:number,textbox',
        ]);

        if (in_array($request->type, ["dropdown", "radio", "checkbox"])) {
            $validatedData['values'] = $request->values
                ? json_encode($request->values, JSON_THROW_ON_ERROR)
                : json_encode([]); // Default to an empty array if values are not provided
        } else {
            $validatedData['values'] = null; // Set to null for types that do not require values
        }

        $customField = CustomField::create([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'required' => $validatedData['required'],
            'is_active' => $request->is_active?1:0,
            'values' => $validatedData['values'],
            'min_length' => $validatedData['min_length'],
            'max_length' => $validatedData['max_length'],
        ]);

        // Handle image upload using Spatie Media Library
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image and associate it with the brand post in the 'images' media collection
            $customField->addMedia($image)
                ->toMediaCollection('images');
        }

        // Assign vendor types to the custom field
        $customField->vendorType()->sync($request->input('vendortype', []));

        // Redirect or send a success message
        return redirect()->route('custom-fields.index')->with('success', 'Custom Field created successfully!');
    }

    public function show($id){
        $customField = CustomField::with('vendorType')->find($id);

        return view('livewire.customfields.show',compact('customField'));
    }

    public function edit($id){
        $customField = CustomField::find($id);
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
        $selectedVendorTypes = $customField->vendorType()->pluck('vendor_type_id')->toArray();
        return view('livewire.customfields.edit',compact('customField','vendorTypes','selectedVendorTypes'));
    }

    public function update(Request $request,$id)
    {
       // Validate the incoming data
        $validatedData = $request->validate([
            'name'       => 'required',
            'type'       => 'required|in:number,textbox,fileinput,radio,dropdown,checkbox',
            'image'      => 'nullable',
            'required'   => 'required',
            'is_active'  => 'nullable',
            'values'     => 'required_if:type,radio,dropdown,checkbox|array',
            'min_length' => 'required_if:number,textbox',
            'max_length' => 'required_if:number,textbox',
        ]);

        if (in_array($request->type, ["dropdown", "radio", "checkbox"])) {
            $validatedData['values'] = $request->values
                ? json_encode($request->values, JSON_THROW_ON_ERROR)
                : json_encode([]); // Default to an empty array if values are not provided
        } else {
            $validatedData['values'] = null; // Set to null for types that do not require values
        }

        $customField = CustomField::findOrFail($id);
        $customField->update([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'required' => $validatedData['required'],
            'is_active' => $request->is_active?1:0,
            'values' => $validatedData['values'],
            'min_length' => $validatedData['min_length'],
            'max_length' => $validatedData['max_length'],
            'values' => $validatedData['values'],
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Clear the old images from the media collection
            $customField->clearMediaCollection('images');  // This removes all images in the 'images' collection

            // Add the new image to the media collection
            $customField->addMedia($request->file('image'))->toMediaCollection('images');
        }

        // Assign vendor types to the custom field
        $customField->vendorType()->sync($request->input('vendortype', []));
        // Redirect with success message
        return redirect()->route('custom-fields.index')->with('success', 'Custom Field updated successfully!');
    }

    public function destroy($id){
        $customField = CustomField::findOrFail($id);
        $customField->delete();
        return redirect()->back()->with('success', 'Custom Field Deleted successfully!');
    }
}
