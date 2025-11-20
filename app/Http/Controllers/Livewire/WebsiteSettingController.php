<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Blogs;
use App\Models\Vendor;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteSettingController extends Controller
{
    public function index(){
        $modules = VendorType::where('is_active',1)->get();
        $check_app_module =AppModule::first() ?? null;
        $vendors = $check_app_module
        ? Vendor::where('vendor_type_id', $check_app_module->vendor_types_id)->get()
        : collect();

        return view('livewire.website_setting.index',compact('modules','vendors','check_app_module'));
    }
    public function create(){

    }

    public function store(Request $request){

        // Validate the incoming request data
        $validatedData = $request->validate([
            'module' => 'required|string',
            'vendors' => 'nullable',
            'vendor'=>'nullable',
            'sub_vendors'=>'nullable'

        ]);
        AppModule::updateOrCreate(
            ['id' => $request->data_id],  // Find the record by the provided ID
            [
                'module_type' => $validatedData['module'],
                'vendor_types_id' => $validatedData['vendors'] ?? null,  // Handle multiple vendors
                'vendor_type' => isset($validatedData['vendors'])  ?  $validatedData['vendor'] : null,
                'vendor_id' => isset($validatedData['sub_vendors']) ? $validatedData['sub_vendors'] : null,
            ]
        );
        return redirect()->back()->with('success', 'Website Setting Changed Successfully.');
    }

    public function show($id){
        $vendors = Vendor::where('vendor_type_id',$id)->get(['id', 'name']);
        return response()->json(['vendors'=>$vendors]);
    }

    public function edit($id){


    }

    public function update(Request $request,$id)
    {


    }

    public function destroy($id){

    }
}
