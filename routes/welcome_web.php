<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Website\ChatController;
use App\Http\Controllers\Website\ParcelController;
use App\Http\Controllers\Website\VendorController;
use App\Http\Controllers\Website\GroceryController;
use App\Http\Controllers\Website\ListingController;
use App\Http\Controllers\Website\ServiceController;
use App\Http\Controllers\Website\WelcomeController;
use App\Http\Controllers\Livewire\CommentController;
use App\Http\Controllers\Website\PharmacyController;
use App\Http\Controllers\Website\EcommerceController;
use App\Http\Controllers\Website\TaxiBookingController;
use App\Http\Controllers\Website\UserListingController;
use App\Http\Controllers\Website\FoodDeliveryController;
use App\Http\Controllers\Auth\AuthController as WebsiteAuthController;

Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return 'Cache cleared!';
});

Route::get('storage_link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

Route::controller(WebsiteAuthController::class)->group(function () {
    Route::post('web/login', 'login')->name('web_login');
    Route::post('web/register', 'register')->name('web_register');
    Route::post('web/logout', 'logout')->name('web_logout');
});

Route::middleware('auth')
    ->controller(CommentController::class)
    ->group(function () {
        Route::post('comment', 'store')->name('comment.store');
    });

Route::controller(WelcomeController::class)->group(function () {
    Route::get('/', 'welcome')->name('welcome');
    Route::get('blog-list', 'blog_list')->name('blog_list');
    Route::get('/blogs/{id}', 'read_blogs')->name('read_blogs');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('shipping_address', 'shipping_address')->name('store.shipping_address');
    Route::get('set_shipping_address/{id}', 'set_shipping_address')->name('set_shipping_address');
    Route::post('placeOrder', 'placeOrder')->name('place_order');
    Route::get('account-orders', 'orders')->name('account-orders');
    Route::get('order-details/{code}', 'order_details')->name('order-details');

    Route::post('product-review/{id}/store', 'product_review')->name('product.review.store');

    Route::get('storagelink', function () {
        Artisan::call('storage:link');
        return 'Storage linked successfully.';
    });


    //Account Setting
    Route::get('account-settings', 'account_settings')->name('account-settings');
    Route::post('user_update', 'updateUser')->name('update_user');
    Route::post('update-password', 'updatePassword')->name('update-password');
    Route::post('delete-account', 'deleteAccount')->name('delete-account');

    //delivery Address
    Route::get('account-address', 'account_address')->name('account-address');
    Route::get('remove_delivery_address/{id}', 'remove_delivery_address')->name('remove_delivery_address');
    Route::get('get-address-details/{id}', 'getAddressDetails');

    Route::get('wishlist', 'wishlist')->name('wishlist');
    //Add product to favourite
    Route::post('favourite', 'add_favourite')->name('add_favourite');
    //Count wishlist
    Route::get('countWishlist', 'countWishlist')->name('countWishlist');
    Route::get('/remove_wishlist_product/{id}', 'remove_wishlist_product')->name('remove_wishlist_product');

    //fetch category wise product\
    Route::post('/cat_realestate', 'cat_realestate')->name('cat_realestate');
    Route::post('/cat_shop', 'cat_shop')->name('cat_shop');
    Route::post('/cat_service', 'cat_service')->name('cat_service');
    Route::post('/search', 'search')->name('search');
    Route::get('/search_by_address/{id}', 'search_by_address')->name('search_by_address');

    // Autocomplete Search
    Route::get('autocomplete-search', 'autocomplete_search')->name('autocomplete_search');
    Route::post('search_web/ajax', 'searchWebAjax')->name('searchWebAjax');
});



Route::middleware(['check.module:commerce'])
    ->controller(EcommerceController::class)
    ->group(function () {
        Route::prefix('e-commerce')->group(function () {
            Route::get('/', 'index')->name('ecommerce.index');
            Route::get('products', 'products')->name('ecommerce.products');
            Route::get('category/{category_id}/products', 'categories_wise_products');
        });

        //Products
        Route::get('/shops', 'shops')->name('ecommerce.shops');
        Route::post('/product_detail', 'product_view')->name('ecommerce.product_detail');
        Route::post('add_product_to_cart', 'add_product_to_cart')->name('ecommerce.add_product_to_cart');
        Route::get('subscribe_product', 'subscribe_product')->name('ecommerce.subscribe_product');
        Route::get('cart', 'cart_products')->name('ecommerce.cart_products');
        Route::post('updateCart', 'updateCart')->name('ecommerce.updateCart');
        Route::get('remove_product/{id}', 'remove_product')->name('ecommerce.remove_product');
        Route::get('product_detail/{id}', 'product_detail')->name('product_details');

        //fetch products by category and subcategory
        Route::post('/category_products', 'category_products')->name('ecommerce.category_products');
        Route::post('/filter_products', 'filter_products')->name('ecommerce.filter_products');
        Route::post('/vendor_wise_products', 'vendor_wise_products')->name('vendor_wise_products');
        Route::post('/subcategory_products', 'subcategory_products')->name('ecommerce.subcategory_products');
        Route::post('/sort_by_products', 'sort_by_products')->name('ecommerce.sort_by_products');

        //cart Product count
        Route::get('countProducts', 'countProducts')->name('cart.count');
    });

//services
Route::middleware(['check.module:service'])
    ->controller(ServiceController::class)
    ->group(function () {
        Route::prefix('services')->group(function () {
            Route::get('/', 'index')->name('ecommerce.index');
            Route::get('products', 'products')->name('ecommerce.products');
            Route::get('category/{category_id}/products', 'categories_wise_products');
            Route::get('product_detail/{id}', 'product_detail')->name('service.product_details');
        });
    });

Route::middleware(['check.module:classified'])
    ->controller(ListingController::class)
    ->group(function () {
        Route::get('listing', 'index')->name('listing');
        /*Route::get('agent_profile/{id}', 'agent_profile')->name('agent_profile');*/
        Route::get('/agent-profile/{id}/{categoryId?}', 'agent_profile')->name('agent_profile');
        Route::get('/listing-view/{id}', 'products_view')->name('products_view');
        Route::post('/product-view-review-store', 'products_review_store')->name('review.store');
        Route::get('/view-all-listing', 'view_all_listing')->name('view.all.listing');
        Route::post('/product-enquiry', 'product_enquiry_store')->name('product.enquiry.store');
        Route::get('/user-product-enquiry', 'viewUserEnquiries')->name('user-product-enquiry');
        Route::post('/user-listing-bookmark', 'listing_save_bookmark')->name('user-listing-bookmark');
        Route::get('/user-listing-bookmark-delete/{id}', 'listing_remove_bookmark')->name('user-listing-bookmark-delete');
        Route::get('/admin/product_enquiry', 'viewAdminEnquiries')->name('admin.product-enquiry');
    });
Route::middleware(['check.module:classified'])
    ->controller(UserListingController::class)
    ->group(function () {
        Route::get('user-add-listing', 'create')->name('user-add-listing');
        Route::post('user-store-listing', 'store')->name('user-store-listing');
        Route::get('/user-index/{userId}', 'user_index')->name('user-index');
        Route::get('/admin-user-index', 'admin_index')->name('admin-user-index');
        Route::post('/admin_index_approved/{id}', 'admin_index_approve')->name('admin_index_approve');
        Route::post('/admin_index_reject/{id}', 'admin_index_reject')->name('admin_index_reject');
        Route::get('/edit-user-product/{productId}', 'user_edit')->name('user-product-edit');
        Route::post('/update-user-product/{productId}', 'user_update')->name('user-product-update');
        Route::get('/delete-user-product/{productId}', 'user_delete')->name('user-product-delete');
        Route::get('districts', 'districts')->name('districts');
        Route::get('cities', 'cities')->name('cities');
    });

//grocery
Route::middleware(['check.module:grocery'])
    ->controller(GroceryController::class)
    ->group(function () {
        Route::prefix('grocery')->group(function () {
            Route::get('/', 'index')->name('ecommerce.index');
            Route::get('products', 'products')->name('ecommerce.products');
            Route::get('category/{category_id}/products', 'categories_wise_products')->name('categories_wise_products');
        });
    });

//Pharmacy
Route::middleware(['check.module:pharmacy'])
    ->controller(PharmacyController::class)
    ->group(function () {
        Route::prefix('pharmacy')->group(function () {
            Route::get('/', 'index')->name('ecommerce.index');
            Route::get('products', 'products')->name('ecommerce.products');
            Route::get('category/{category_id}/products', 'categories_wise_products')->name('categories_wise_products');
        });
    });

//taxi bookings
Route::middleware(['check.module:food'])
    ->controller(FoodDeliveryController::class)
    ->group(function () {
        Route::prefix('food-delivery')->group(function () {
            Route::get('/', 'index')->name('ecommerce.index');
            Route::get('products', 'products')->name('ecommerce.products');
            Route::get('category/{category_id}/products', 'categories_wise_products')->name('categories_wise_products');
        });
    });

//Parcel Delivery
Route::middleware(['check.module:parcel'])->group(function () {
    Route::get('parcel-delivery', function () {
        return view('livewire.website.modules.parcel_delivery.index');
    })->name('parcel-delivery');
});

//Taxi Booking
Route::middleware(['check.module:taxi'])->group(function () {
    Route::get('taxi-booking', function () {
        return view('livewire.website.modules.taxi_booking.index');
    })->name('taxi-booking');
});

Route::get('forgot-password', function () {
    return view('livewire.website.user-profile.auth.forgot-password');
})->name('forgot-password');

// Route::get('vendor-list', function () {
//     return view('livewire.website.partials.vendors');
// })->name('vendor-list');

Route::get('vendor-list', [VendorController::class, 'vendorList'])->name('vendor-list');

Route::get('account-payment-method', function () {
    return view('livewire.website.user-profile.account-payment-method');
})->name('account-payment-method');

Route::get('account-notification', function () {
    return view('livewire.website.user-profile.account-notification');
})->name('account-notification');

Route::get('shopView', function () {
    return view('livewire.website.partials.shopView');
})->name('shopView');

Route::get('shop/detail/{id}', [VendorController::class, 'shopDetail'])->name('shop.detail');

Route::get('about', function () {
    return view('livewire.website.partials.about');
})->name('about');

Route::get('404error', function () {
    return view('livewire.website.partials.404error');
})->name('404error');

Route::get('contact', function () {
    return view('livewire.website.partials.contact');
})->name('contact');

// listing
Route::get('ad-list', function () {
    return view('livewire.website.modules.listing.partials.ad-list');
})->name('ad-list');

Route::get('ad-details', function () {
    return view('livewire.website.modules.listing.partials.ad-details');
})->name('ad-details');

Route::get('ad-listing', function () {
    return view('livewire.website.user-profile.ad-post');
})->name('ad-listing');

Route::get('my-ads', function () {
    return view('livewire.website.user-profile.my-ads');
})->name('my-ads');

Route::post('forgot-password/sent-otp', [AuthController::class, 'sendOtp'])->name('forgot-password.sent-otp');
Route::post('forgot-password/verify-otp', [AuthController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
Route::post('forgot-password/reset-password', [AuthController::class, 'resetPassword'])->name('forgot-password.reset-password');

Route::get('shoplist', function () {
    return view('livewire.website.modules.shoplist');
})->name('shoplist');

Route::view('construct', 'livewire.website.construction_planner')->name('construction.planner');

Route::get('agent-profile/{id}', [EcommerceController::class, 'agent_profile'])->name('agent-profile');
Route::get('agent-profile/{id}/category/{categoryId}', [EcommerceController::class, 'agent_profile_filter'])->name('agent-profile-filter');
// Route::get('agent-profile/{id}',function($id){
//     return view('livewire.website.modules.listing.vendor_profile');
// })->name('agent-profile');

Route::get('verify-phone', [WebsiteAuthController::class, 'verifyPhone'])->name('verify.phone');
Route::post('auth-verify-phone', [WebsiteAuthController::class, 'authVerifyPhone'])->name('auth.verify.phone');

Route::get('login', function () {
    return view('livewire.website.user-profile.auth.login');
})->name('login');

Route::get('register', function () {
    return view('livewire.website.user-profile.auth.register');
})->name('register');

Route::get('compare', function () {
    return view('livewire.website.section.compare');
})->name('compare');

/*Route::middleware(['auth'])->group(function () {
    Route::get('message',[ChatController::class,'messages'])->name('message');
    Route::get('message/seller/{id}',[ChatController::class,'messages_seller'])->name('messages_seller');
    Route::post('send-message',[ChatController::class,'sendMessage'])->name('send-message');
    Route::post('vendor-message', [ChatController::class, 'vendorMessage'])->name('vendor-message');
});*/

Route::middleware(['auth'])->group(function () {
    Route::get('message', [ChatController::class, 'messages'])->name('message');
    Route::post('send-message', [ChatController::class, 'sendMessage'])->name('send-message');
    Route::post('vendor-message', [ChatController::class, 'vendorMessage'])->name('vendor-message');
    Route::get('/message/{vendorId}', [ChatController::class, 'startChat'])->name('message.startchat');
});

Route::post('get-compare-products', [EcommerceController::class, 'getCompareProducts'])->name('get-compare-products');

Route::get('calander', function () {
    return view('livewire.website.partials.calander');
})->name('calander');

// Route For Testing Push Notification
Route::get('/test-push', function () {
    $fcmToken = 'crvHGk_eSTC37LHAuIRa3U:APA91bEkQJ3WoJNXR5P0hIVPV4nAJ7lk34O_LMbzDlZDJ54sXbhhioiTHKCUoNdw323WwbrPK8ThCu4MIbvJhj-cKji6T9hVJO6zlpYnm98hvXqGYvaPNQY';

    $factory = (new \Kreait\Firebase\Factory)
    ->withServiceAccount('/home/food.matinsoftech.com/public_html/storage/app/vault/firebase_service.json');

    $messaging = $factory->createMessaging();

    $notification = \Kreait\Firebase\Messaging\Notification::create(
        'Test Push',
        'This is a test push from Laravel'
    );

    $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $fcmToken)
        ->withNotification($notification);

    try {
        $messaging->send($message);
        return 'Push notification sent!';
    } catch (\Throwable $e) {
        return 'Error: '.$e->getMessage();
    }
});