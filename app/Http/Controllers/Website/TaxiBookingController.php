<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\VendorType;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxiBookingController extends Controller
{
    protected $vendor_name = "Taxi Booking";
    public function index(){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $banners = Banner::with('vendor_type')->whereHas('vendor_type', function ($query) use($vendor_type_id) {
            $query->where('vendor_type_id', $vendor_type_id);
        })
        ->get();
        $categories = Category::where('vendor_type_id',$vendor_type_id)->get();

        $products = Product::with('vendor','categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->get();

        $few_products = Product::with('vendor','categories','favourites')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->limit(5)->get();

        return view('livewire.website.modules.ecommerce.index',compact('banners','categories','products','few_products'));
    }

    public function products(){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',8)->where('is_active',1)->get();
        $all_products = Product::with('vendor','categories','favourites')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->get();

        // return view('livewire.website.modules.ecommerce.section.shopView',compact('categories','all_products'));
        return view('livewire.website.modules.ecommerce.section.products',compact('categories','all_products'));
    }
    public function categories_wise_products($category_id){
      
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',$vendor_type_id)->where('is_active',1)->get();
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {

        $all_products =  Product::with('vendor','categories','sub_categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id',$this->app_module->vendor_id)
                ->whereHas('categories',function($query) use ($category_id) {
                    $query->where('id',$category_id);
                })
                 ->paginate(10);
            }else{
                $all_products =  Product::with('vendor','categories','sub_categories')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->whereHas('categories',function($query) use ($category_id) {
                        $query->where('id',$category_id);
                    })
                     ->paginate(10);
            }

            $brands = Brand::get(['id','name']);
            $delivery_zones = DeliveryZone::get(['id','name']);
        return view('livewire.website.modules.ecommerce.section.products',compact('categories','all_products','brands','delivery_zones'));
    }
}
