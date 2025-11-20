<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductEnquiry;
use App\Models\VendorType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryZone;
use App\Models\Favourite;
use App\Models\Vendor;
use App\Models\Viewer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ListingController extends Controller
{
    public function index()
    {
        $categories = Category::where('vendor_type_id', 9)->get();
        $delievery_zones = DeliveryZone::all();
        $products = Product::where('vendor_type_id', 9)->where('feature_status', 1)->get();
        $popular_products = Product::where('vendor_type_id', 9)->latest('id')->get();
        return view('livewire.website.modules.listing.index', compact('categories', 'delievery_zones', 'products', 'popular_products'));
    }
    public function products_view($id)
    {
        $product = Product::with(['vendor_types', 'vendor', 'userInfo'])->findOrFail($id);
        $isBookmarked = false;
        $favouriteId = null;

        if (Auth::check()) {
            $favourite = Favourite::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($favourite) {
                $isBookmarked = true;
                $favouriteId = $favourite->id;
            }
        }
        /*$vendor = $product->vendor;
        if ($vendor) {
            $productCount = $vendor->products()->count();
        } else {
            $productCount = 0; 
        }*/

        // Determine if the product is added by a vendor or user
        $isVendorProduct = $product->vendor ? true : false;
        $author = $isVendorProduct ? $product->vendor : ($product->userInfo ? $product->userInfo : null);
        $productCount = $isVendorProduct ? $product->vendor->products()->count() : 0;

        $vendorTypeId = 9;
        $products_all = Product::where('vendor_type_id', $vendorTypeId)->where('feature_status', 1)->get();
        $related_product = Product::where('vendor_type_id', $vendorTypeId)->inRandomOrder()->take(3)->get();
        $reviews = DB::table('products_details_review_store')->where('product_id', $id)->get();
        $reviewCount = $reviews->count();

        // Viewer Tracking
        $user_id = Auth::id();
        $viewer_ip = request()->ip();

        Viewer::firstOrCreate([
            'user_id' => $user_id,
            'product_id' => $id,
            'viewer_ip' => $viewer_ip,
        ]);

        $total_listing_view = Viewer::where('product_id', $id)->count();
        return view('livewire.website.modules.listing.partials.ad-details', compact('product', 'products_all', 'related_product', 'reviews', 'reviewCount', 'productCount', 'isBookmarked', 'favouriteId', 'total_listing_view', 'isVendorProduct', 'author'));
    }

    /*public function agent_profile(string $id)
    {
        $vendor_detail = Vendor::where('id', $id)->first();
        $vendor_products = Product::where('vendor_id', $id)->with('categories')->paginate(12);
        return view('livewire.website.modules.listing.agent_profile', compact('vendor_detail', 'vendor_products'));
    }*/

    public function agent_profile(string $id)
    {
        $vendor_detail = Vendor::where('id', $id)->first();

        // Get all unique categories for this vendor's products
        $categories = Category::whereHas('products', function ($query) use ($id) {
            $query->where('vendor_id', $id);
        })->distinct()->get();

        $vendor_products = Product::where('vendor_id', $id)
            ->with('categories')
            ->paginate(12);

        if (request()->ajax()) {
            $categoryId = request()->input('category_id');

            if ($categoryId) {
                $vendor_products = Product::where('vendor_id', $id)
                    ->whereHas('categories', function ($query) use ($categoryId) {
                        $query->where('categories.id', $categoryId);
                    })
                    ->with('categories')
                    ->paginate(12);
            }

            return response()->json([
                'html' => view('livewire.website.modules.listing.partials.agent_products', compact('vendor_products'))->render()
            ]);
        }

        return view('livewire.website.modules.listing.agent_profile', compact('vendor_detail', 'vendor_products', 'categories'));
    }
    public function products_review_store(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'You must be logged in to leave a review.');
        }
        \DB::table('products_details_review_store')->insert([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'quote' => $request->quote,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Thank you for your review!');
    }
    public function view_all_listing(Request $request)
    {
        $show = $request->input('show', 15);
        $sort = $request->input('sort', 'default');
        $layout = $request->input('layout', 3);
        $types = $request->input('types', []);
        $cities = $request->input('cities', []);
        $category_id = $request->input('category_id', null);
        $ratings = $request->input('ratings', []);
        $min_price = $request->input('min_price', null);
        $max_price = $request->input('max_price', null);
        $query = Product::where('vendor_type_id', 9)->with('vendor_types');
        $categories = Category::withCount(['products'])->get();
        //dd($categories);
        if ($category_id) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('categories.id', $category_id);
            });
        }
        if (!empty($ratings)) {
            $query->whereIn('products.id', function ($subQuery) use ($ratings) {
                $subQuery->select('product_id')->from('products_details_review_store')->whereIn('rating', $ratings);
            });
        }
        if (!is_null($min_price) && !is_null($max_price)) {
            $query->whereBetween('price', [$min_price, $max_price]);
        }
        switch ($sort) {
            case 'trending':
                $query->orderBy('trending_score', 'desc');
                break;
            case 'featured':
                $query->orderBy('featured_score', 'desc');
                break;
            case 'recommend':
                $query->orderBy('recommendation_score', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        if (!empty($types)) {
            $query->whereIn('ad_type', $types);
        }
        if (!empty($cities)) {
            $query->where(function ($q) use ($cities) {
                foreach ($cities as $city) {
                    $q->orWhere('address', 'like', '%' . $city . '%');
                }
            });
        }
        $product_ad_type = Product::select('ad_type', DB::raw('COUNT(*) as count'))->groupBy('ad_type')->get();
        $distinct_ad_types = Product::select('ad_type')->whereNotNull('ad_type')->groupBy('ad_type')->pluck('ad_type')->toArray();
        $distinct_cities = Product::select('address')
            ->whereNotNull('address')
            ->where('address', '!=', '')
            ->distinct()
            ->pluck('address')
            ->map(function ($address) {
                $parts = explode(',', $address);
                return trim(end($parts));
            })
            ->unique()
            ->toArray();
        $products = $query->paginate($show);
        if ($request->ajax()) {
            return view('livewire.website.modules.listing.partials.filtered_product', compact('products'))->render();
        }
        return view('livewire.website.modules.listing.partials.ad-list', compact('products', 'product_ad_type', 'distinct_cities', 'distinct_ad_types', 'categories'));
    }
    public function product_enquiry_store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors('error', 'You need to be logged in to submit an enquiry.');
        }
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);
        ProductEnquiry::create($validatedData);
        return redirect()->back()->with('success', 'Enquiry submitted successfully!');
    }
    public function viewUserEnquiries()
    {
        if (!Auth::check()) {
            return redirect()->back('login')->withErrors('error', 'You need to be logged in to view your enquiries.');
        }
        $userEnquiries = ProductEnquiry::where('user_id', Auth::id())->with('product')->get();
        return view('livewire.website.user-profile.account-enquiry', compact('userEnquiries'));
    }
    /*public function viewAdminEnquiries()
    {
        if (!Auth::check()) {
            return redirect()->back('login')->withErrors('error', 'You need to be logged in to view your enquiries.');
        }
        $enquiries = ProductEnquiry::with(['user', 'product'])
            ->latest()
            ->paginate(10);
        return view('livewire.product-enquiries', compact('enquiries'));
    }*/

    public function viewAdminEnquiries()
    {
        $enquiries = ProductEnquiry::with(['user', 'product'])
            ->when(!in_array(auth()->id(), [1, 2]), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('livewire.product-enquiries', compact('enquiries'));
    }

    public function listing_save_bookmark(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in to save this product.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Favourite::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Product Saved Successfully');
    }

    public function listing_remove_bookmark($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in to unsave this product.');
        }

        $listing_bookmark = Favourite::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$listing_bookmark) {
            return redirect()->back()->with('error', 'Bookmark not found or unauthorized action.');
        }

        $listing_bookmark->delete();

        return redirect()->back()->with('success', 'Product UnSaved Successfully');
    }
}
