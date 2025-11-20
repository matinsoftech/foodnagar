<?php

namespace App\Http\Controllers\Website;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Brand;
use App\Models\Order;
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
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use App\Http\Controllers\API\RegularOrderController;
use Illuminate\Database\Eloquent\Relations\Relation;


class EcommerceController extends Controller
{

    protected $vendor_name = "E-commerce";
    protected $app_module;

    public function __construct() {
        $this->app_module = AppModule::firstOrFail();
    }

    public function index(){

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        $vendorType = VendorType::whereId($vendor_type_id)->first();

        $vendors = Vendor::where('vendor_type_id', $vendor_type_id)->get();

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
        return view('livewire.website.modules.ecommerce.index',compact('vendorType','vendors','banners','categories','products','few_products','latest_products','categories_products','flashSales','vendor_name'));
    }

    public function shops(){

        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", ['E-commerce'])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',8)->where('is_active',1)->get();
        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
         $all_products = Product::with('vendor','categories','favourites')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->where('vendor_id',$this->app_module->vendor_id)
                    ->paginate(10);
        }else{
          $all_products = Product::with('vendor','categories','favourites')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->paginate(10);
            }

        return view('livewire.website.modules.ecommerce.section.shopView',compact('categories','all_products'));
    }

    public function products(){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $categories = Category::with('sub_categories')->where('vendor_type_id',$vendor_type_id)->where('is_active',1)->get();
        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
            $all_products = Product::with('vendor','categories','favourites')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->where('vendor_id',$this->app_module->vendor_id ?? null)
                        ->paginate(10);
        }
        else{
            $all_products = Product::with('vendor','categories','favourites')
            ->whereHas('vendor', function ($query) use($vendor_type_id) {
                $query->where('vendor_type_id', $vendor_type_id);
            })
            ->paginate(10);
        }
        $brands = Brand::get(['id','name']);
        $delivery_zones = DeliveryZone::get(['id','name']);
        $vendor_name = $this->vendor_name;
        // return view('livewire.website.modules.ecommerce.section.shopView',compact('categories','all_products'));
        return view('livewire.website.modules.ecommerce.section.products',compact('categories','all_products','brands','delivery_zones','vendor_name'));
    }



    public function product_view(Request $request){

        $vendor_name = $this->vendor_name;
       if($request->module_name == 'Home Services'){
            $product_detail = Service::with(['vendor', 'categories', 'sub_categories','options'])
            ->find($request->id);
            $vendor_name = 'Home Services';

       }else{

            $product_detail = Product::with(['vendor', 'categories', 'sub_categories','options'])
            ->find($request->id);
       }


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


        $image_html = view('livewire.website.modals.modal_images', compact('images'))->render();
        $html = view('livewire.website.modals.quick-view', compact('product_detail','discount_percent','vendor_name'))->render();

        // Return the rendered HTML in a JSON response
        return response()->json(['html' => $html,'images'=>$image_html]);
    }

    public function product_detail($id){

        $product_detail = Product::with(['vendor', 'categories', 'sub_categories', 'sub_sub_categories', 'options','brand'])
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
        $total_products = Product::where('vendor_id', $product_detail->vendor_id)->count();
        $similarProducts = Product::with('vendor','categories','sub_categories')
                        ->where('vendor_type_id',$product_detail->vendor_type_id)
                        ->where('id','!=',$id)
                        ->limit(10)
                        ->get();

        return view('livewire.website.modules.product.details',compact('images','product_detail','discount_percent','comments','productFaqs','productReviews', 'total_products', 'vendor_name','similarProducts'));
    }

    public function filter_products(Request $request){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        $category_id = $request->category_id;


        $query =  Product::with('vendor','categories','sub_categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id, $request) {
                    $query->where('vendor_type_id', $vendor_type_id);
                    if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
                    {
                      $query->where('vendor_id',$this->app_module->vendor_id);
                    }

                    if ($request->delivery_zone_id) {
                        $query->whereHas('delivery_zone', function ($query) use ($request) {
                            $query->where('id', $request->delivery_zone_id);
                        });
                    }
                })
                ->when($request->brand_id, function ($query) use ($request) {
                    $query->where('brand_id', $request->brand_id);
                });

        if($request->category_id){
            $query->whereHas('categories', function($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        }

        if($request->sub_category_id){
            $query->whereHas('sub_categories', function($query) use ($request) {
                $query->where('id', $request->sub_category_id);
            });
        }

        if($request->product_type){
            $query->where('digital', $request->product_type);
        }

        $sort_by = $request->input('sort_by');

        // Apply sorting logic based on selected option
        switch ($sort_by) {
            case 'Low to High':
                $query->orderBy('discount_price', 'asc'); // Sort by price ascending
                break;
            case 'High to Low':
                $query->orderBy('discount_price', 'desc'); // Sort by price descending
                break;
            case 'Release Date':
                $query->orderBy('updated_at', 'desc'); // Sort by most recent release
                break;
            case 'Avg. Rating':
                $query->orderBy('avg_rating', 'desc'); // Sort by average rating
                break;
            default:
                $query->orderBy('id', 'desc'); // Default sorting (e.g., newest first)
                break;
        }

        if ($request->rating) {
            $ratings = (array) $request->input('rating'); // Ensure $ratings is always an array

            $query->whereHas('reviews', function ($query) use ($ratings) {
                $query->selectRaw('AVG(rating) as avg_rating, product_id')
                      ->groupBy('product_id')
                      ->having(function ($havingQuery) use ($ratings) {
                          foreach ($ratings as $rating) {
                              $rating = (int) $rating; // Convert to integer for safety
                              $havingQuery->orHavingRaw('(avg_rating >= ? AND avg_rating < ?)', [$rating, $rating + 1]);
                          }
                      });
            });
        }

        $all_products = $query->get();

        $html = view('livewire.website.modules.ecommerce.section.fetch_products',compact('all_products'))->render();
        return response()->json(['status'=>true,'products'=>$html]);
    }
    public function category_products(Request $request){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        $category_id = $request->category_id;
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
                ->get();
            }else{
                $all_products =  Product::with('vendor','categories','sub_categories')
                    ->whereHas('vendor', function ($query) use($vendor_type_id) {
                        $query->where('vendor_type_id', $vendor_type_id);
                    })
                    ->whereHas('categories',function($query) use ($category_id) {
                        $query->where('id',$category_id);
                    })
                    ->get();
            }


        $html = view('livewire.website.modules.ecommerce.section.fetch_products',compact('all_products'))->render();
        return response()->json(['status'=>true,'products'=>$html]);
    }

    public function subcategory_products(Request $request){
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');
        $subcategory_id = $request->subcategory_id;

        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
        $all_products =  Product::with('vendor','categories','sub_categories')
                        ->whereHas('vendor', function ($query) use($vendor_type_id) {
                            $query->where('vendor_type_id', $vendor_type_id);
                        })
                        ->where('vendor_id',$this->app_module->vendor_id )
                        ->whereHas('sub_categories',function($query) use ($subcategory_id) {
                            $query->where('id',$subcategory_id);
                        })
                        ->get();
        }else{
            $all_products =  Product::with('vendor','categories','sub_categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->whereHas('sub_categories',function($query) use ($subcategory_id) {
                    $query->where('id',$subcategory_id);
                })
                ->get();
        }

        $html = view('livewire.website.modules.ecommerce.section.fetch_products',compact('all_products'))->render();
        return response()->json(['status'=>true,'products'=>$html]);

    }

    public function sort_by_products(Request $request) {
        $vendor_type_id = VendorType::whereRaw("JSON_EXTRACT(name, '$.en') = ?", [$this->vendor_name])->pluck('id');

        $sort_by = $request->input('sort_by'); // Get the selected sorting option


        if($this->app_module->vendor_type == 'single' && $this->app_module->module_type == 'single')
        {
        $query = Product::with('vendor', 'categories', 'sub_categories')
                ->whereHas('vendor', function ($query) use($vendor_type_id) {
                    $query->where('vendor_type_id', $vendor_type_id);
                })
                ->where('vendor_id',$this->app_module->vendor_id);
        }else{
            $query = Product::with('vendor', 'categories', 'sub_categories')
            ->whereHas('vendor', function ($query) use($vendor_type_id) {
                $query->where('vendor_type_id', $vendor_type_id);
            });
        }

        // Apply sorting logic based on selected option
        switch ($sort_by) {
            case 'Low to High':
                $query->orderBy('discount_price', 'asc'); // Sort by price ascending
                break;
            case 'High to Low':
                $query->orderBy('discount_price', 'desc'); // Sort by price descending
                break;
            case 'Release Date':
                $query->orderBy('updated_at', 'desc'); // Sort by most recent release
                break;
            case 'Avg. Rating':
                $query->orderBy('avg_rating', 'desc'); // Sort by average rating
                break;
            default:
                $query->orderBy('id', 'desc'); // Default sorting (e.g., newest first)
                break;
        }

        $all_products = $query->get();


        $html = view('livewire.website.modules.ecommerce.section.fetch_products',compact('all_products'))->render();
        return response()->json(['status'=>true,'products'=>$html]);
    }

   public function add_product_to_cart(Request $request){


       if (!Auth::check()) {
             return response()->json(['success' => false, 'message' => 'You must be logged in to add items to the cart'], 201);
        }

        $itemcheck = Cart::where('user_id', auth()->user()->id)
                    ->where(function ($query) use ($request) {
                        $query->where('product_id', $request->product_id)
                            ->orWhere('service_id', $request->product_id);
                    })
                    ->exists();

        if($itemcheck){
            return response()->json(['success' => false, 'message' => 'This Item is already in the cart'], 201);
        }


         try {
            if($request->module_name == 'Services'){
                $check = Cart::where('user_id', auth()->user()->id)
                         ->whereNotNull('product_id')
                         ->exists();

                if ($check) {
                    return response()->json(['success' => false, 'message' => 'First empty the E-commerce Product from the cart'], 201);
                }

                $product_detail =  Service::find($request->product_id);
                if (!$product_detail) {
                    return response()->json(['success' => false, 'message' => 'Service not found'], 404);
                }
                $cart_data =[
                   'user_id'=>Auth::user()->id,
                   'service_id'=>$product_detail->id,
                   'vendor_id'=>$product_detail->vendor_id,
                   'product_price'=>$product_detail->discount_price != null ? $product_detail->discount_price : $product_detail->price,
                   'quantity' => $request->quantity,
                   'price' => (int)$request->quantity * ($product_detail->discount_price != null ? $product_detail->discount_price : $product_detail->price),
                ];
            }else{

                $check = Cart::where('user_id', auth()->user()->id)
                            ->whereNotNull('service_id')
                            ->exists();

                if ($check) {
                    return response()->json(['success' => false, 'message' => 'First empty the Service items from the cart'], 201);
                }

                $product_detail =  Product::find($request->product_id);
                if (!$product_detail) {
                    return response()->json(['success' => false, 'message' => 'Product not found'], 404);
                }
                $cart_data =[
                   'user_id'=>Auth::user()->id,
                   'product_id'=>$product_detail->id,
                   'vendor_id'=>$product_detail->vendor_id,
                   'product_price'=>$product_detail->discount_price != null ? $product_detail->discount_price : $product_detail->price,
                   'quantity' => $request->quantity,
                   'price' => (int)$request->quantity * ($product_detail->discount_price != null ? $product_detail->discount_price : $product_detail->price),
                ];
            }




             Cart::create($cart_data);

            return response()->json(['success'=>true,
            'message'=> 'Product Added to Cart']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
   }

    public function countProducts()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $products = Cart::with('hasproduct')
                        ->where('user_id', $userId)
                        ->orderBy('created_at', 'desc') // Optional: Sort by most recent
                        ->take(5)
                        ->get();
            $cartCount = Cart::where('user_id', $userId)->count();
            return response()->json(['count' => $cartCount,'products'=>$products]);
        } else {
            return response()->json(['count' => 0]);
        }
    }

    public function cart_products(RegularOrderController $regularOrderController){
        if (Auth::check()) {
            $cart_products = Cart::with(['hasproduct.vendor', 'hasService.vendor'])
                ->where('user_id', auth()->user()->id)
                ->get()
                ->groupBy(function ($item) {
                    return $item->hasproduct ? $item->hasproduct->vendor->name : $item->hasService->vendor->name;
                });

            $subtotal = Cart::where('user_id', auth()->user()->id)->sum('price');
        } else {
            $cart_products = collect(); // Use collect for consistency in structure
            $subtotal = 0;
        }
        $delivery_charges = 0;
        $destination_location = DeliveryAddress::where('user_id', auth()->user()->id)
            ->where('is_default', 1)
            ->select('latitude', 'longitude', 'id') // Include the delivery address ID
            ->first();
        if($destination_location){

            $delivery_charges = $this->delivery_fee($regularOrderController);
        }

        $total_amount = $subtotal + (int)$delivery_charges;

        return view('livewire.website.partials.cart',compact('cart_products','subtotal','total_amount','delivery_charges'));
    }

    public function updateCart(Request $request)
    {
        $cartItem = Cart::find($request->id);

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->price = $request->quantity * $cartItem->product_price;
            $cartItem->save();

            return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found']);
    }


    public function remove_product($id){
        if (Auth::check()) {
            $cartItem = Cart::find($id);

            if ($cartItem) {
                $cartItem->delete();
                session()->flash('success', 'Product removed from cart successfully.');
            } else {
                session()->flash('error', 'Product not found in cart.');
            }

            return redirect()->back();
        }
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

    public function agent_profile(string $id){
        $vendor_detail = Vendor::where('id', $id)->first();
        $vendor_products = Product::where('vendor_id', $id)->with('categories')->paginate(12);
        return view('livewire.website.modules.listing.agent_profile', compact('vendor_detail', 'vendor_products'));
    }

    public function agent_profile_filter($id, $categoryId)
    {
        $category = Category::with('products')->find($categoryId);
        $vendor_detail = Vendor::where('id', $id)->first();
        $vendor_products = Product::where('vendor_id', $id)
                                ->whereHas('categories', function($query) use ($categoryId) {
                                    $query->where('category_id', $categoryId);
                                })
                                ->with('categories')
                                ->paginate(12);
        return view('livewire.website.modules.listing.agent_profile', compact('vendor_detail', 'vendor_products'));
    }
    private function delivery_fee($regularOrderController){
        $vendor_datas = Cart::with(['hasproduct.vendor', 'hasService.vendor'])
                        ->where('user_id', auth()->user()->id)
                        ->get()
                        ->groupBy(function ($item) {
                            $vendor = $item->hasproduct ? $item->hasproduct->vendor : $item->hasService->vendor;

                            // Use vendor ID as the key
                            return $vendor->id;
                        })
                        ->map(function ($products, $vendorId) {
                            $vendor = $products->first()->hasproduct
                                ? $products->first()->hasproduct->vendor
                                : $products->first()->hasService->vendor;

                            return [
                                'vendor_id' => $vendorId,
                                'vendor_name' => $vendor->name,
                                'products' => $products, // Keep the grouped products
                            ];
                        });


        $destination_location = DeliveryAddress::where('user_id', auth()->user()->id)
            ->where('is_default', 1)
            ->select('latitude', 'longitude', 'id') // Include the delivery address ID
            ->first();

        if ($destination_location) {
            $destination_latlng = $destination_location->latitude . ',' . $destination_location->longitude;
            $delivery_address_id = $destination_location->id;
        } else {
            // Handle the case where no default address is found
            $destination_latlng = '27.7172,85.3240'; // Fallback location
            $delivery_address_id = null;
        }

        if (!$destination_latlng) {
            $destination_latlng = '27.7172,85.3240'; // Default fallback location
        }

    // Initialize a controller instance for calculating delivery charges


        $delivery_charges = [];

        foreach ($vendor_datas as $vendorData) {
            $request = new Request([
                'vendor_id' => $vendorData['vendor_id'],
                'delivery_address_id' => $delivery_address_id, // Default address ID
                'latlng' => $destination_latlng, // Destination coordinates
            ]);

            $delivery_charge_response = $regularOrderController->deliveryFeeSummary($request);

            $delivery_charges[] = [
                'vendor_id' => $vendorData['vendor_id'],
                'vendor_name' => $vendorData['vendor_name'],
                'delivery_charge' => $delivery_charge_response, // Add response from deliveryFeeSummary
            ];
        }


        $total_delivery_fee = 0;

        // Loop through the delivery charges array
        foreach ($delivery_charges as $charge) {
            // Get the delivery fee from the JsonResponse
            $delivery_fee = $charge['delivery_charge']->getData()->delivery_fee;

            // Add it to the total
            $total_delivery_fee += $delivery_fee;
        }


        return number_format($total_delivery_fee,2);
    }

    public function getCompareProducts(Request $request){
        $products = Product::whereIn('id',$request->comparedProducts)->get();

        $view = view('ssr.compare',compact('products'))->render();

        return response()->json(['success' => true, 'view' => $view]);
    }

    public function subscribe_product(){

        return view('livewire/website/partials/subscribe-product');
    }
}
