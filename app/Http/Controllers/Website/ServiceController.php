<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Vendor;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;

use App\Models\AppModule;

use App\Models\FlashSale;
use App\Models\ProductFaq;
use App\Models\VendorType;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\Relation;

class ServiceController extends Controller
{
    protected $vendor_name = "Home Services";
    protected $app_module;

    public function __construct() {
        $this->app_module = AppModule::firstOrFail();
    }

    public function index(){

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        $banners = Banner::with('vendor_type')->whereHas('vendor_type', function ($query) use($vendor_type_id) {
            $query->where('vendor_type_id', $vendor_type_id);
        })
        ->get();

        $categories = Category::where('vendor_type_id',$vendor_type_id)->get();



        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
            $products = Service::with('vendor','categories')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->where('vendor_id',$this->app_module->vendor_id)
                    ->paginate(10);

            $few_products = Service::with('vendor','categories')
                            ->whereHas('vendor', function ($query) use($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)

                        ->limit(5)->get();
            $latest_products = Service::with('vendor', 'categories')
                            ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)
                            ->latest('id')
                            ->limit(5)
                            ->get();

            $categories_products = Service::with('vendor', 'categories')
                            ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)
                            ->limit(5)
                            ->get()
                            ->groupBy(function ($product) {
                                // Check if the product has a category and that category is not empty
                                return $product->categories && $product->categories->name? $product->categories->name : 'Uncategorized';
                            });
        }else{
            $products = Service::with('vendor','categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })

                ->paginate(10);

            $few_products = Service::with('vendor','categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })

                      ->limit(5)->get();
            $latest_products = Service::with('vendor', 'categories')
                        ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->latest('id')
                        ->limit(5)
                        ->get();
            $categories_products = Service::with('vendor', 'categories')
                        ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->limit(5)
                        ->get()
                        ->groupBy(function ($product) {
                            // Check if the product has a category and that category is not empty
                            return $product->categories && $product->categories->name? $product->categories->name : 'Uncategorized';
                        });
        }

        $flashSales = FlashSale::with(['FlashSaleItem.product.categories'])
                        ->where('expires_at', '>', Carbon::now())
                        ->where('is_active', 1)
                        ->get();

                    // Filter items with associated products
                    $flashSales = $flashSales->map(function ($flashSale) {
                        $flashSale->items = $flashSale->items->filter(function ($item) {
                            return $item->product;
                        });
                        return $flashSale;
                    });

                 $vendor_name = $this->vendor_name;

                 $vendorType = VendorType::whereId($vendor_type_id)->first();
                 $vendors = Vendor::where('vendor_type_id', $vendor_type_id)->get();
                 return view('livewire.website.modules.ecommerce.index',compact('vendorType','vendors','vendor_name','flashSales','banners','categories','products','few_products','latest_products','categories_products'));
    }

    public function products(){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',$vendor_type_id)->where('is_active',1)->get();

        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
            $all_products = Service::with('vendor','categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->where('vendor_id',$this->app_module->vendor_id)
                        ->paginate(10);
        }
        else{
            $all_products = Service::with('vendor','categories')
            ->whereHas('vendor', function ($query) use($vendor_type_id) {
                $query->where('vendor_type_id', $vendor_type_id);
            })
            ->paginate(10);
        }
        $brands = Brand::get(['id','name']);
        $delivery_zones = DeliveryZone::get(['id','name']);
        $vendor_name = $this->vendor_name;

        return view('livewire.website.modules.ecommerce.section.products',compact('categories','all_products','brands','delivery_zones','vendor_name'));
    }

    public function categories_wise_products($category_id){

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',$vendor_type_id)->where('is_active',1)->get();
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
            if (request()->is('services/category*'))
                {
                    $all_products =  Service::with('vendor','categories','sub_categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->whereHas('categories',function($query) use ($category_id) {
                            $query->where('id',$category_id);
                        })
                        ->where('vendor_id',$this->app_module->vendor_id )
                        ->paginate(10);
                }else{
                    $all_products =  Product::with('vendor','categories','sub_categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->whereHas('categories',function($query) use ($category_id) {
                            $query->where('id',$category_id);
                        })
                        ->where('vendor_id',$this->app_module->vendor_id )
                        ->paginate(10);
                }

            }else{
                if (request()->is('services/category*'))
                {
                    $all_products =  Service::with('vendor','categories','sub_categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
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
            }
            $brands = Brand::get(['id','name']);
            $delivery_zones = DeliveryZone::get(['id','name']);
            $vendor_name = $this->vendor_name;

        return view('livewire.website.modules.ecommerce.section.products',compact('categories','all_products','brands','delivery_zones','vendor_name'));
    }

    public function product_detail($id){

        $product_detail = Service::with(['vendor', 'categories', 'sub_categories','options','brand'])
        ->find($id);


        $price = $product_detail->price;
        $discount_price = $product_detail->discount_price;
        $discount_percent = (($price - $discount_price) / $price) * 100;

        // Round the result to 2 decimal places if needed
        $discount_percent = round($discount_percent, 2);

        // Check if the product exists
        if (!$product_detail) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $images = $product_detail->getMedia('default')->map(function ($image) {
            return $image->getUrl();
        });

        $comments = Comment::with('user')->where('thread_id',0)->where('product_id',$id)->get();

        foreach($comments as $comment){
            $comment->replies = Comment::where('thread_id',$comment->id)->get();
        }

        $productFaqs = ProductFaq::where('product_id',$id)->get();
        $productReviews = ProductReview::with('user')->where('product_id',$id)->get();
        $vendor_name = $this->vendor_name;
        $total_products = service::where('vendor_id', $product_detail->vendor_id)->count();
        $similarProducts = service::with('vendor','categories','sub_categories')
                            ->where('vendor_id',$product_detail->vendor_id)
                            ->where('id','!=',$id)
                            ->limit(10)
                            ->get();
        return view('livewire.website.modules.product.details',compact('images','similarProducts','product_detail','discount_percent','comments','productFaqs','productReviews','vendor_name','total_products'));
    }
}
