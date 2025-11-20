<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserProductInfo;

class UserListingController extends Controller
{
    public function districts(Request $request)
    {
        $provinceId = $request->input('province_id');
        $districts = DB::table('districts')->where('province_id', $provinceId)->get();

        return response()->json([
            'success' => true,
            'data' => $districts,
        ]);
    }

    // Fetch cities for a given district
    public function cities(Request $request)
    {
        $districtId = $request->input('district_id');
        $cities = DB::table('municipalities')->where('district_id', $districtId)->get();

        return response()->json([
            'success' => true,
            'data' => $cities,
        ]);
    }
    public function user_index($userId)
    {
        if (!Auth::check()) {
              return redirect()->back('login')->withErrors('error', 'You need to be logged in to view your enquiries.');
          }
        $user_product = Product::whereHas('userInfo', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with(['categories', 'userInfo'])
            ->get();
        foreach ($user_product as $product) {
            $product->province = DB::table('provinces')
                ->where('province_id', $product->province_id)
                ->first();
            $product->district = DB::table('districts')
                ->where('district_id', $product->district_id)
                ->first();
            $product->city = DB::table('municipalities')
                ->where('municipality_id', $product->city_id)
                ->first();
        }

        return view('livewire.website.user-profile.user_product.user-index', compact('user_product'));
    }

    public function admin_index()
    {
        $user_product = Product::whereHas('userInfo')
            ->with(['categories', 'userInfo'])
            ->get();
        foreach ($user_product as $product) {
            $product->province = DB::table('provinces')
                ->where('province_id', $product->province_id)
                ->first();
            $product->district = DB::table('districts')
                ->where('district_id', $product->district_id)
                ->first();
            $product->city = DB::table('municipalities')
                ->where('municipality_id', $product->city_id)
                ->first();
        }

        return view('livewire.user_added_product', compact('user_product'));
    }

    public function admin_index_approve($id)
    {
        $user_product = Product::findorFail($id);
        $user_product->user_approve = 1;
        $user_product->save();
        return redirect()->back()->with('success', 'User Added Product approved successfully');

    }

    public function admin_index_reject($id)
    {
        $user_product = Product::findOrFail($id);
        $user_product->user_approve = 0;
        $user_product->save(); 
        return redirect()->back()->with('success', 'User Added Product rejected successfully');

    }

    public function create()
    {
        $user = Auth::user();
        $provinces = DB::table('provinces')->orderBy('province_id', 'ASC')->get();
        $categories = Category::all();
        return view('livewire.website.user-profile.user_product.ad-post', compact('provinces', 'categories', 'user'));
    }

    /*public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'price' => $request->price ?? null,
            'unit' => $request->unit ?? null,
            'ad_type' => $request->ad_type ?? null,
        ]);

        if ($request->hasFile('image')) {
            $product->addMedia($request->file('image'))->toMediaCollection('images');
        }

        // Save category and user-related data
        DB::table('category_product')->insert([
            'product_id' => $product->id,
            'category_id' => $request->category_id,
        ]);

        DB::table('product_user_info')->insert([
            'product_id' => $product->id,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Product created successfully.');
    }*/

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'city_id' => $request->city_id,
                'price' => $request->price ?? null,
                'unit' => $request->unit ?? null,
                'ad_type' => $request->ad_type ?? null,
                'vendor_type_id' => 9,
            ]);

            if ($request->hasFile('image')) {
                $product->addMedia($request->file('image'))->toMediaCollection('images');
            }

            DB::table('category_product')->insert([
                'product_id' => $product->id,
                'category_id' => $request->category_id,
            ]);

            DB::table('product_user_info')->insert([
                'product_id' => $product->id,
                'user_id' => Auth::check() ? Auth::id() : null,
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error creating product: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function user_edit($productId)
    {
        $product = Product::findOrFail($productId);
        $product->unit = $product->unit ? explode(',', $product->unit) : [];
        $product->ad_type = $product->ad_type ? explode(',', $product->ad_type) : [];

        $provinces = DB::table('provinces')->orderBy('province_id', 'ASC')->get();
        $categories = Category::all();

        $product->province = DB::table('provinces')
            ->where('province_id', $product->province_id)
            ->first();
        $product->district = DB::table('districts')
            ->where('district_id', $product->district_id)
            ->first();
        $product->city = DB::table('municipalities')
            ->where('municipality_id', $product->city_id)
            ->first();

        $product->selected_category_ids = $product->categories->pluck('id')->toArray();

        $productUserInfo = DB::table('product_user_info')->where('product_id', $productId)->first();

        return view('livewire.website.user-profile.user_product.user-edit', compact('product', 'provinces', 'categories', 'productUserInfo'));
    }

    public function user_update(Request $request, $productId)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($productId);

            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'province_id' => 'required|integer',
                'district_id' => 'required|integer',
                'city_id' => 'required|integer',
                'price' => 'nullable|numeric',
                'unit' => 'array|nullable',
                'ad_type' => 'array|nullable',
                'category_id' => 'required|integer',
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email',
                'user_phone' => 'required|string|max:15',
                'user_address' => 'required|string|max:255',
                'image' => 'nullable|image|max:2048', 
            ]);

            // Update the product's main attributes
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'city_id' => $request->city_id,
                'price' => $request->price ?? null,
                'unit' => $request->unit ? implode(',', $request->unit) : null,
                'ad_type' => $request->ad_type ? implode(',', $request->ad_type) : null,
                'user_approve' => null,
            ]);

            if ($request->hasFile('image')) {
                $product->clearMediaCollection('images');

                $product->addMedia($request->file('image'))->toMediaCollection('images');
            }

            DB::table('category_product')
                ->where('product_id', $product->id)
                ->update(['category_id' => $request->category_id]);

            DB::table('product_user_info')
                ->where('product_id', $product->id)
                ->update([
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error updating product: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }



    public function user_delete($productId)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($productId);

            // Delete related entries
            DB::table('category_product')->where('product_id', $productId)->delete();
            DB::table('product_user_info')->where('product_id', $productId)->delete();

            // Delete the product itself
            $product->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error deleting product: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
