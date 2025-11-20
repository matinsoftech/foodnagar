<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\AppModule;
use App\Models\FlashSale;
use App\Models\VendorType;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class FoodDeliveryController extends Controller
{
    protected $vendor_name = "Food Delivery";
    protected $app_module;

    public function __construct()
    {
        $this->app_module = AppModule::firstOrFail();
    }
    /*public function index(){

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $banners = Banner::with('vendor_type')->whereHas('vendor_type', function ($query) use($vendor_type_id) {
            $query->where('vendor_type_id', $vendor_type_id);
        })
        ->get();
        $categories = Category::where('vendor_type_id',$vendor_type_id)->get();


        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
            $products = Product::with('vendor','categories')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->where('vendor_id',$this->app_module->vendor_id)
                    ->paginate(10);

            $few_products = Product::with('vendor','categories','favourites')
                            ->whereHas('vendor', function ($query) use($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)
                            ->where('feature_status',1)
                        ->limit(5)->get();
            $latest_products = Product::with('vendor', 'categories', 'favourites')
                            ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)
                            ->latest('id')
                            ->limit(5)
                            ->get();
            $categories_products = Product::with('vendor', 'categories', 'favourites')
                            ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                                $query->where('vendor_type_id', $vendor_type_id);
                            })
                            ->where('vendor_id',$this->app_module->vendor_id)
                            ->limit(5)
                            ->get()
                            ->groupBy(function ($product) {
                                return $product->categories->isNotEmpty() ? $product->categories->first()->name : 'Uncategorized';
                            });
        }else{
            $products = Product::with('vendor','categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })

                ->paginate(10);

            $few_products = Product::with('vendor','categories','favourites')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->where('feature_status',1)
                      ->limit(5)->get();
            $latest_products = Product::with('vendor', 'categories', 'favourites')
                        ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->latest('id')
                        ->limit(5)
                        ->get();
            $categories_products = Product::with('vendor', 'categories', 'favourites')
                        ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->limit(5)
                        ->get()
                        ->groupBy(function ($product) {
                            return $product->categories->isNotEmpty() ? $product->categories->first()->name : 'Uncategorized';
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
*/

    public function index()
    {
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])
            ->pluck('id');

        $banners = Banner::with('vendor_type')
            ->whereHas('vendor_type', function ($query) use ($vendor_type_id) {
                $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
            })
            ->get();

        $categories = Category::whereNotNull('vendor_type_id')
            ->where('vendor_type_id', $vendor_type_id)
            ->get();

        if ($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single') {
            $products = Product::with('vendor', 'categories')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->paginate(10);

            $few_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->where('feature_status', 1)
                ->limit(5)
                ->get();

            $latest_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->latest('id')
                ->limit(5)
                ->get();

            $categories_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->limit(5)
                ->get()
                ->groupBy(function ($product) {
                    return $product->categories->isNotEmpty() ? $product->categories->first()->name : 'Uncategorized';
                });
        } else {
            $products = Product::with('vendor', 'categories')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->paginate(10);

            $few_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->where('feature_status', 1)
                ->limit(5)
                ->get();

            $latest_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->latest('id')
                ->limit(5)
                ->get();

            $categories_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id);
                })
                ->limit(5)
                ->get()
                ->groupBy(function ($product) {
                    return $product->categories->isNotEmpty() ? $product->categories->first()->name : 'Uncategorized';
                });
        }

        $flashSales = FlashSale::with(['FlashSaleItem.product.categories'])
            ->where('expires_at', '>', Carbon::now())
            ->where('is_active', 1)
            ->get();

        // Filter out items with no associated products
        $flashSales = $flashSales->map(function ($flashSale) {
            $flashSale->items = $flashSale->items->filter(function ($item) {
                return $item->product;
            });
            return $flashSale;
        });

        $vendor_name = $this->vendor_name;
        $vendorType = VendorType::whereNotNull('id')->whereId($vendor_type_id)->first();
        $vendors = Vendor::whereNotNull('vendor_type_id')->where('vendor_type_id', $vendor_type_id)->get();

        return view('livewire.website.modules.ecommerce.index', compact(
            'vendorType',
            'vendors',
            'vendor_name',
            'flashSales',
            'banners',
            'categories',
            'products',
            'few_products',
            'latest_products',
            'categories_products'
        ));
    }

    public function products()
    {
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id', 8)->where('is_active', 1)->get();
        if ($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single') {
            $all_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->paginate(10);
        } else {
            $all_products = Product::with('vendor', 'categories', 'favourites')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->paginate(10);
        }
        $brands = Brand::get(['id', 'name']);
        $delivery_zones = DeliveryZone::get(['id', 'name']);
        // return view('livewire.website.modules.ecommerce.section.shopView',compact('categories','all_products'));
        return view('livewire.website.modules.ecommerce.section.products', compact('categories', 'all_products', 'brands', 'delivery_zones'));
    }

    public function categories_wise_products($category_id)
    {

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id', $vendor_type_id)->where('is_active', 1)->get();
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        if ($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single') {

            $all_products =  Product::with('vendor', 'categories', 'sub_categories')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id', $this->app_module->vendor_id)
                ->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('id', $category_id);
                })
                ->paginate(10);
        } else {
            $all_products =  Product::with('vendor', 'categories', 'sub_categories')
                ->whereHas('vendor', function ($query) use ($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('id', $category_id);
                })
                ->paginate(10);
        }

        $brands = Brand::get(['id', 'name']);
        $delivery_zones = DeliveryZone::get(['id', 'name']);
        return view('livewire.website.modules.ecommerce.section.products', compact('categories', 'all_products', 'brands', 'delivery_zones'));
    }
}
