<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Blogs;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    public function index(){
        $blogs = Blogs::with('module')->paginate(10);
        return view('livewire.blogs.index',compact('blogs'));
    }
    public function create(){
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

        return view('livewire.blogs.create',compact('vendortypes'));
    }

    public function store(Request $request){


        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'vendortype'=>'required'
        ]);

        $blog = Blogs::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'is_active' => $request->is_published  ? 1 : 0,
            'vendortype_id'=>$validatedData['vendortype'],
        ]);

        // Handle image upload using Spatie Media Library
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Store the image and associate it with the blog post in the 'images' media collection
            $blog->addMedia($image)
                ->toMediaCollection('images');
        }

        // Redirect or send a success message
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function show($id){
        $blog = Blogs::with('module')->find($id);

        return view('livewire.blogs.show',compact('blog'));
    }

    public function edit($id){
        $blog = Blogs::find($id);
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
        return view('livewire.blogs.edit',compact('blog','vendortypes'));
    }

    public function update(Request $request,$id)
    {

       // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'vendortype'=>'required'
        ]);

        // Find the blog and update
        $blog = Blogs::findOrFail($id);
        $blog->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'is_active' => $request->is_published  ? 1 : 0,
            'vendortype_id'=>$validatedData['vendortype'],
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Clear the old images from the media collection
            $blog->clearMediaCollection('images');  // This removes all images in the 'images' collection

            // Add the new image to the media collection
            $blog->addMedia($request->file('image'))->toMediaCollection('images');
        }


        // Redirect with success message
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id){
        $blog = Blogs::findOrFail($id);
        $blog->delete();
        return redirect()->back()->with('success', 'Blog Deleted successfully!');
    }
}
