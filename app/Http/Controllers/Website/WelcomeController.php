<?php

namespace App\Http\Controllers\Website;


use App\Models\Cart;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Category;
use App\Models\AppModule;
use App\Models\Favourite;
use App\Models\VendorType;
use App\Models\Testinomial;
use App\Models\LoyaltyPoint;
use App\Models\OrderProduct;
use App\Models\OrderService;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ProductReview;
use App\Models\CategoryProduct;
use App\Models\DeliveryAddress;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use App\Http\Controllers\API\RegularOrderController;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $moduleConfig = AppModule::first();
        $vendorType = VendorType::find($moduleConfig->vendor_types_id);

        if ($moduleConfig->module_type === 'single' && $vendorType) {
            // Check if the user has access to the specific vendor type for this module
            if ($vendorType->slug == "commerce") {
                return redirect()->to('/e-commerce');
            } elseif ($vendorType->slug == "service") {
                return redirect()->to('/services');
            } elseif ($vendorType->slug == "classified") {
                return redirect()->to('/listing');
            } elseif ($vendorType->slug == "grocery") {
                return redirect()->to('/grocery');
            } elseif ($vendorType->slug == "pharmacy") {
                return redirect()->to('/pharmacy');
            } elseif ($vendorType->slug == "food") {
                return redirect()->to('/food-delivery');
            } elseif ($vendorType->slug == "parcel") {
                return redirect()->to('/parcel-delivery');
            } elseif ($vendorType->slug == "taxi") {
                return redirect()->to('/taxi-booking');
            }
        }
        $banners = Banner::where('vendor_type_id', NUll)->with('vendor_type')->get();
        $vendortypes = VendorType::all();
        $testinomials = Testinomial::where('is_active', 1)->get();
        $blogs = Blogs::where('is_active', 1)->get();
        $cat_ecommerce = Category::with('products')
            ->where('vendor_type_id', 8)
            ->where('is_active', 1)
            ->limit(10)
            ->get();
        $cat_realestate = Category::with('products')
            ->where('vendor_type_id', 9)
            ->where('is_active', 1)
            ->limit(5)
            ->get();
        $cat_services = Category::with('products')
            ->where('vendor_type_id', 5)
            ->where('is_active', 1)
            ->limit(5)
            ->get();
        $categories = [
            'shops' => $cat_ecommerce,
            'realestate' => $cat_realestate,
            'services' => $cat_services
        ];

        return view('livewire.website.welcome', compact('banners', 'vendortypes', 'testinomials', 'blogs', 'categories'));
    }

    public function blog_list()
    {
        $blogs = Blogs::paginate(6);
        return view('livewire.website.section.blog-list', compact('blogs'));
    }
    public function read_blogs($id)
    {
        $blog = Blogs::find($id);
        return view('livewire.website.partials.blog_details', compact('blog'));
    }

    public function checkout(RegularOrderController $regularOrderController)
    {

        if (Auth::check()) {

            $cart_products = Cart::with('hasproduct', 'hasService')->where('user_id', auth()->user()->id)->get();
            $subtotal = Cart::where('user_id', auth()->user()->id)->sum('price');
            $shipping_address = DeliveryAddress::where('user_id', auth()->user()->id)->get();
            do {
                // Generate a random shopping code
                $shopping_id = rand(111111111, 9999999999);

                // Check if the code already exists in the database
                $check_code = Order::where('code', $shopping_id)->first();
            } while ($check_code); // Repeat until a unique code is found


        } else {
            $cart_products = [];
            $subtotal = 0;
            $shipping_address = [];
            $shopping_id = "";
        }

        $delivery_charges = 0;
        $destination_location = DeliveryAddress::where('user_id', auth()->user()->id)
            ->where('is_default', 1)
            ->select('latitude', 'longitude', 'id') // Include the delivery address ID
            ->first();
        if ($destination_location) {

            $delivery_charges = $this->delivery_fee($regularOrderController);
        }

        $total_amount = $subtotal + (int)$delivery_charges;

        $payment_methods = PaymentMethod::where('is_active', 1)->get();

        return view('livewire.website.partials.checkout', compact('cart_products', 'total_amount', 'subtotal', 'shipping_address', 'shopping_id', 'payment_methods', 'delivery_charges'));
    }

    public function shipping_address(Request $request)
    {


        $validateData = $request->validate([
            'id' => 'nullable',
            'address' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'delivery_category' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'description' => 'nullable',
            'default_status' => 'nullable',
        ]);



        // Add the `user_id` manually
        $validateData['user_id'] = auth()->user()->id;

        $address_data = [
            'name' =>   $validateData['name'],
            'phone' =>   $validateData['phone'],
            'address' => $validateData['address'],
            'latitude' => $validateData['latitude'],
            'longitude' => $validateData['longitude'],
            'description' => $validateData['description'],
            'city' => $validateData['city'],
            'state' => $validateData['state'],
            'country' => $validateData['country'],
            'delivery_category' => $validateData['delivery_category'],
            'is_default' => $validateData['default_status'] ?? 0,
            'user_id' => $validateData['user_id']
        ];



        // Create the shipping address
        $data = DeliveryAddress::updateOrCreate(['id' => $validateData['id']], $address_data);
        if ($data) {
            if ($validateData['id']) {
                session()->flash('success', 'Shipping Address Updated successfully.');
            } else {

                session()->flash('success', 'Shipping Address Added successfully.');
            }
        } else {
            session()->flash('error', 'Something Went Wrong ');
        }

        return redirect()->back();
    }

    public function set_shipping_address($id)
    {
        DeliveryAddress::where('user_id', auth()->id())->update(['is_default' => 0]);

        // Set the selected shipping address as default
        $data = DeliveryAddress::where('id', $id)->where('user_id', auth()->id())->update(['is_default' => 1]);

        // Flash appropriate message based on success or failure
        if ($data) {
            session()->flash('success', 'Default Delivery Address updated successfully.');
        } else {
            session()->flash('error', 'Something went wrong. Please try again.');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function remove_delivery_address($id)
    {

        // Set the selected shipping address as default
        $data = DeliveryAddress::where('id', $id)->where('user_id', auth()->id())->delete();

        // Flash appropriate message based on success or failure
        if ($data) {
            session()->flash('success', 'Default Delivery Address Removed successfully.');
        } else {
            session()->flash('error', 'Something went wrong. Please try again.');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function getAddressDetails($id)
    {
        $address = DeliveryAddress::findOrFail($id);
        return response()->json($address);
    }

    public function placeOrder(Request $request)
    {

        // Validate the request
        $validateData = $request->validate([
            'shopping_code' => 'required',
            'delivery_instructions' => 'nullable',
            'delivery_fee' => 'nullable',
            'total_amount' => 'nullable',
            'subtotal' => 'nullable'

        ]);

        // Fetch cart products for the current user
        $cart_products = Cart::with('hasproduct', 'hasService')->where('user_id', auth()->user()->id,)->get();


        // Calculate subtotal


        if ($cart_products->isEmpty()) {
            session()->flash('error', 'Your cart is empty. Please add items to proceed with the order.');
            return redirect()->back();
        }

        DB::beginTransaction(); // Start transaction

        try {
            $delivery_address =   DeliveryAddress::where([
                'user_id' => auth()->user()->id,
                'is_default' => 1
            ])->first();

            if (!$delivery_address) {
                session()->flash('error', 'Please set Delivery Address.');
                return redirect()->back();
            }
            $firstVendor = $cart_products->first()->hasproduct->vendor_id ?? null;
            $order_data = [
                'code' => $validateData['shopping_code'],
                'note' => $validateData['delivery_instructions'],
                'sub_total' => $validateData['subtotal'],
                'total' => $validateData['total_amount'],
                'user_id' => auth()->user()->id,
                'delivery_fee' => $validateData['delivery_fee'] ?? null,
                'delivery_address_id' => $delivery_address->id,
                'payment_method_id' => $request->payment_method, // Hardcoded; consider making this dynamic
                'vendor_id' => $firstVendor,
            ];


            // Create order data
            $order = Order::create($order_data);


            // Insert order products
            foreach ($cart_products as $cart_product) {

                if (!empty($cart_product->product_id)) {
                    // Add product details to the order
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'quantity' => $cart_product->quantity,
                        'product_price' => $cart_product->product_price,
                        'price' => $cart_product->price,
                        'product_id' => $cart_product->product_id,
                        'vendor_id' => $cart_product->hasproduct->vendor_id ?? null, // Assuming the product relationship is defined
                    ]);
                } elseif (!empty($cart_product->service_id)) {

                    $serviceDuration = $cart_product->hasService->duration ?? null;
                    $order_servicedata = [
                        'order_id' => $order->id,
                        'service_id' => $cart_product->service_id,
                        'price' => $cart_product->price,
                        'hours' => $serviceDuration == 'hour' ? $cart_product->quantity : null,
                        'day' => $serviceDuration == 'day' ? $cart_product->quantity : null,
                        'month' => $serviceDuration == 'month' ? $cart_product->quantity : null,
                        'year' => $serviceDuration == 'year' ? $cart_product->quantity : null,
                    ];

                    // Add service details to the order
                    OrderService::insert(
                        $order_servicedata
                    );
                } else {
                    // Handle unexpected cases (optional)
                    Log::warning('Cart product with no product_id or service_id detected.', ['cart_product' => $cart_product]);
                }
            }


            // Clear cart after order placement
            Cart::where('user_id', auth()->user()->id)->delete();

            DB::commit(); // Commit transaction

            // Flash success message
            session()->flash('success', 'Your order has been successfully placed.');

            return redirect()->route('account-orders'); // Redirect to an appropriate page
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction

            // Log the error for debugging
            Log::error('Order Placement Failed: ' . $e->getMessage());

            // Flash error message
            session()->flash('error', 'Something went wrong while placing your order. Please try again.');

            return redirect()->back();
        }
    }

    public function orders()
    {
        if (Auth::check()) {
            $orders = Order::with(['products', 'order_service', 'vendor', 'payment_method'])
                ->where('user_id', auth()->user()->id)->latest('id')->get();
        } else {
            $orders = [];
        }

        return view('livewire.website.user-profile.account-orders', compact('orders'));
    }

    /*public function order_details($code)
    {

        $orders_details = OrderProduct::with(['product.reviews', 'order'])
            ->whereHas('order', function ($query) use ($code) {
                $query->where('code', $code)
                    ->where('user_id', auth()->user()->id);
            })->get();

        if ($orders_details->isEmpty()) { // Check if the collection is empty
            $orders_details = OrderService::with(['product', 'order'])
                ->whereHas('order', function ($query) use ($code) {
                    $query->where('code', $code)
                        ->where('user_id', auth()->user()->id);
                })->get();
        }


        $order = Order::with(['user', 'delivery_address', 'payment_method'])->where('code', $code)->first();


        return view('livewire.website.user-profile.order-details', compact('orders_details', 'code', 'order'));
    }*/

    public function order_details($code)
    {

        $orders_details = OrderProduct::with(['product.reviews', 'order'])
            ->whereHas('order', function ($query) use ($code) {
                $query->where('code', $code)
                    ->where('user_id', auth()->user()->id);
            })->get();
        if ($orders_details->isEmpty()) { // Check if the collection is empty
            $orders_details = OrderService::with(['product', 'order'])
                ->whereHas('order', function ($query) use ($code) {
                    $query->where('code', $code)
                        ->where('user_id', auth()->user()->id);
                })->get();
        }


        // $order = Order::with(['user', 'delivery_address', 'payment_method', 'statuses'])->where('code', $code)->first();
        $order = Order::with(['user', 'delivery_address', 'payment_method', 'vendor'])
            ->where('code', $code)
            ->whereHas('statuses') // Ensure statuses exist for the order
            ->first();


        return view('livewire.website.user-profile.order-details', [
            'orders_details' => $orders_details,
            'code' => $code,
            'order' => $order,
            'statuses' => $order ? $order->statuses : collect()
        ]);

        // return view('livewire.website.user-profile.order-details', compact('orders_details', 'code', 'order'));
    }

    public function account_settings()
    {
        return view('livewire.website.user-profile.account-settings');
    }

    public function updateUser(Request $request)
    {


        $validatedData = $request->validate([
            'user_name' => 'nullable|string|max:255',
            'user_email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'user_phone' => 'nullable|string|max:15',
        ]);

        // Update the user's details
        $user = Auth::user();
        $user->update([
            'name' => $validatedData['user_name'],
            'email' => $validatedData['user_email'],
            'phone' => $validatedData['user_phone'],
        ]);

        // Redirect with a success message
        session()->flash('success', 'Your details have been updated successfully.');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

        // Validate the form data
        $validateData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8', // Use `confirmed` for a password confirmation field
        ]);
        // dd($validateData);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            session()->flash('error', 'The current password is incorrect.');
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        session()->flash('success', 'Password updated successfully!');
        return redirect()->back();
    }

    public function deleteAccount(Request $request)
    {
        // Validate the password field
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        // Check if the entered password matches the user's current password
        if (!Hash::check($request->password, $user->password)) {
            session()->flash('error', 'The password you entered is incorrect.');
            return back()->withErrors(['password' => 'The password you entered is incorrect.']);
        }

        // Perform account deletion
        $user->delete();

        // Optionally, log out the user
        Auth::logout();
        session()->flash('success', 'Your account has been deleted successfully.');
        // Redirect with a success message
        return redirect('/');
    }

    public function account_address()
    {
        if (Auth::check()) {
            $shipping_address = DeliveryAddress::where('user_id', auth()->user()->id)->get();
        } else {
            $shipping_address = [];
        }
        return view('livewire.website.user-profile.account-address', compact('shipping_address'));
    }

    public function add_favourite(Request $request)
    {

        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to manage favourites.'], 200);
        }

        // Find the product
        if ($request->module_name == 'Services') {
            $product = Service::find($request->product_id);
        } else {
            $product = Product::find($request->product_id);
        }

        // Check if the product exists
        if (!$product) {

            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 201);
        }

        // Check if the product is already a favourite
        if ($request->module_name == 'Services') {
            $existingFavourite = Favourite::where('user_id', auth()->id())
                ->where('service_id', $product->id)
                ->first();
        } else {
            $existingFavourite = Favourite::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();
        }

        if ($existingFavourite) {
            // If the product is already a favourite, remove it
            $existingFavourite->forceDelete();
            return response()->json([
                'success' => true,
                'message' => 'Favourite removed successfully!'
            ]);
        } else {

            if ($request->module_name == 'Services') {
                $data = [
                    'user_id' => auth()->id(),
                    'service_id' => $product->id
                ];
            } else {
                $data = [
                    'user_id' => auth()->id(),
                    'product_id' => $product->id
                ];
            }


            // If the product is not a favourite, add it
            Favourite::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Favourite added successfully!'
            ]);
        }
    }

    public function countWishlist()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $products = Favourite::with('product', 'service')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc') // Optional: Sort by most recent
                ->take(5)
                ->get();

            $wishlistCount = Favourite::where('user_id', $userId)->count();

            return response()->json(['count' => $wishlistCount, 'products' => $products]);
        } else {
            return response()->json(['count' => 0]);
        }
    }

    public function wishlist()
    {

        if (Auth::check()) {
            $userId = Auth::id();
            $wishlists = Favourite::with('product', 'service')->where('user_id', $userId)->get();

            return view('livewire.website.partials.wishlist', compact('wishlists'));
        } else {
            return redirect()->route('login');
        }
    }

    public function remove_wishlist_product($id)
    {

        // Set the selected shipping address as default
        $data = Favourite::where('id', $id)->where('user_id', auth()->id())->delete();

        // Flash appropriate message based on success or failure
        if ($data) {
            session()->flash('success', ' Removed Product from Wishlist.');
        } else {
            session()->flash('error', 'Something went wrong. Please try again.');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }


    public function filterProducts(Request $request)
    {
        $categoryId = $request->category_id;

        // Fetch products that belong to the selected category
        $products = Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        })->get();

        // Return the filtered product list from the new Blade file path
        return view('livewire.website.section.ajax.filtered_products', compact('products'))->render();
    }



    public function cat_realestate(Request $request)
    {
        $category_id = $request->category_id;
        // $vendor_type_id = 5;
        // $realestates =  Product::with('vendor','categories','sub_categories')
        //     ->whereHas('vendor', function ($query) use($vendor_type_id) {
        //             $query->where('vendor_type_id', $vendor_type_id);
        //         })
        //         ->whereHas('categories',function($query) use ($category_id) {
        //             $query->where('id',$category_id);
        //         })
        //         ->get();

        $realestates = CategoryProduct::with('product')
            ->where('category_id', $category_id)
            ->get()
            ->pluck('product');




        $html = view('livewire.website.section.ajax.realestate', compact('realestates'))->render();
        return response()->json(['status' => true, 'products' => $html]);
    }

    public function cat_shop(Request $request)
    {
        $category_id = $request->category_id;

        $vendor_type_id = 8;
        // $ecommerces =  Product::with('vendor','categories','sub_categories')
        //     ->whereHas('categories',function($query) use ($category_id) {
        //         $query->where('id',$category_id);
        //     })
        //     ->get();

        $ecommerces = CategoryProduct::with('product')
            ->where('category_id', $category_id)
            ->get()
            ->pluck('product');



        $html = view('livewire.website.section.ajax.product', compact('ecommerces'))->render();
        return response()->json(['status' => true, 'products' => $html]);
    }

    public function cat_service(Request $request)
    {
        $category_id = $request->category_id;
        $vendor_type_id = 5;
        // $services =  Product::with('vendor','categories','sub_categories')
        // ->whereHas('vendor', function ($query) use($vendor_type_id) {
        //         $query->where('vendor_type_id', $vendor_type_id);
        //     })
        //     ->whereHas('categories',function($query) use ($category_id) {
        //         $query->where('id',$category_id);
        //     })
        //     ->get();

        $services = CategoryProduct::with('product')
            ->where('category_id', $category_id)
            ->get()
            ->pluck('product');


        $html = view('livewire.website.section.ajax.service', compact('services'))->render();
        return response()->json(['status' => true, 'products' => $html]);
    }

    public function product_review(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required',
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'review' => 'required',
        ]);

        $productReview = ProductReview::where('product_id', $request->product_id)->where('order_id', $request->order_id)->first();

        if (!$productReview) {
            $productReview = new ProductReview();
        }

        $productReview->user_id = auth()->id();
        $productReview->product_id = $request->product_id;
        $productReview->order_id = $request->order_id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->save();

        return response()->json(['status' => true, 'message' => 'Review added successfully']);
    }

    function search(Request $request)
    {
        $query = $request->input('search', '');

        // Fetch filtered data

        $search_products = Product::with('vendor', 'vendor_types')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->get()
            ->groupBy(function ($product) {
                return $product->vendor_types ? $product->vendor_types->name : 'Uncategorized';
            });
        $total_products = Product::where('name', 'LIKE', '%' . $query . '%')->count();


        return view('livewire.website.search', compact('search_products', 'total_products'));
    }

    function search_by_address(Request $request, $id)
    {

        $query = $id;
        $data = DeliveryZone::with('vendors')->find($id);
        $vendor_id = $data->vendors->pluck('id')->toArray();


        // Fetch filtered data

        $search_products = Product::with('vendor', 'vendor_types')
            ->whereHas('vendor', function ($query) use ($vendor_id) {
                $query->WhereIn('id', $vendor_id);
            })
            ->get()
            ->groupBy(function ($product) {
                return $product->vendor_types ? $product->vendor_types->name : 'Uncategorized';
            });

        $total_products = Product::with('vendor', 'vendor_types')
            ->whereHas('vendor', function ($query) use ($vendor_id) {
                $query->WhereIn('id', $vendor_id);
            })
            ->count();


        return view('livewire.website.search', compact('search_products', 'total_products'));
    }

    function autocomplete_search(Request $request)
    {
        $query = $request->input('query', '');

        // Validate query
        if (empty($query)) {
            return response()->json(['filter_data' => []]);
        }

        // Fetch filtered data
        $filter_data = Product::where('name', 'LIKE', '%' . $query . '%')
            ->limit(10) // Limit the number of results
            ->pluck('name'); // Fetch only 'name' column

        return response()->json(['filter_data' => $filter_data]);
    }

    private function delivery_fee($regularOrderController)
    {
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


        return number_format($total_delivery_fee, 2);
    }
}
