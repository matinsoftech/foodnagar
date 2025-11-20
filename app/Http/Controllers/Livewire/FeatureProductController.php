<?php

namespace App\Http\Controllers\Livewire;

use App\Models\Blogs;
use App\Models\AppModule;
use App\Models\VendorType;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\SubCategories;
use App\Models\FeatureProduct;
use App\Models\Brand;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureProductController extends Controller
{
    public function index()
    {
        $feature_product = FeatureProduct::orderBy('id','DESC')->paginate(10);
        // dd($feature_product);
        return view('livewire.feature-product.index',compact('feature_product'));
    }
    public function create()
    {
        
        $product = Product::all();
        return view('livewire.feature-product.create', compact('product'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'product_id'=>'required',
            'priority' => 'nullable|integer|min:0|max:99',
        ]);

        $feature_product = FeatureProduct::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'product_id'=>json_encode($validatedData['product_id']),
            'priority' => $validatedData['priority'],

        ]);
        return redirect()->route('feature_product.index')->with('message', 'Feature Product Created Successfully.');
    }
    public function show($id)
    {
        $feature_product = FeatureProduct::findOrFail($id);
        $product = Product::all();
        return view('livewire.feature-product.show', compact('feature_product', 'product'));
    }

    public function edit($id)
    {
        $feature_product = FeatureProduct::findOrFail($id);
        $product = Product::all();
        return view('livewire.feature-product.edit', compact('feature_product', 'product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'product_id'=>'required',
            'priority' => 'nullable|integer|min:0|max:99',
        ]);
        $feature_product = FeatureProduct::findorFail($id);
        $feature_product->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'product_id' => json_encode($validatedData['product_id']),
            'priority' => $validatedData['priority'],
        ]);
        return redirect()->route('feature_product.index')->with('message', 'Feature Product Updated Successfully.');
    }
    public function destroy($id)
    {
        $feature_product = FeatureProduct::findOrFail($id);
        $feature_product->delete();
        return redirect()->route('feature_product.index')->with('message', 'Feature Product Deleted Successfully.');
    }
     
}