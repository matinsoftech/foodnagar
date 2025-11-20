<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Category;
use App\Models\AppModule;
use App\Models\VendorType;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCatgoryController extends Controller
{
    public function index(){
        $subsubcategories = SubSubCategory::with('category','subcategory')->paginate(10);
        return view('livewire.subsubcategory.index',compact('subsubcategories'));
    }
    public function create(){
         $categories = Category::where('is_active',1)->get();

        return view('livewire.subsubcategory.create',compact('categories'));
    }

    public function store(Request $request){

       
      // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
        ]);

        $subsubcategory = SubSubCategory::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'sub_category_id' => $validatedData['sub_category_id'],
            'is_active' => 1,
        ]);


       

          // Redirect or send a success message
          return redirect()->route('subsubcategory.index')->with('success', 'SubSubCategory created successfully!');
    }

    public function show($id){
        $subsubcategory = SubSubCategory::with('category','subcategory')->find($id);

        return view('livewire.subsubcategory.show',compact('subsubcategory'));
    }

    public function edit($id){
        $subsubcategory = SubSubCategory::with('category','subcategory')->find($id);
        $subcatgeories = Subcategory::where('category_id',$subsubcategory->category_id)->get();
        $categories = Category::where('is_active',1)->get();
        return view('livewire.subsubcategory.edit',compact('subsubcategory','categories','subcatgeories'));
    }

    public function update(Request $request,$id)
    {

       // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'nullable|integer',
        ]);

        // Find the blog and update
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->update([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'sub_category_id' => $validatedData['sub_category_id'],
            'is_active' => $request->is_active,
        ]);

       
        // Redirect with success message
        return redirect()->route('subsubcategory.index')->with('success', 'SubSubCategory updated successfully!');
    }

    public function destroy($id){
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->delete();
        return redirect()->back()->with('success', 'SubSubCategory Deleted successfully!');
    }

    public function getSubcategories($id)
    {
       
        $subcategories = Subcategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

}
