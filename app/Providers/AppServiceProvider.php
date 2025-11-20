<?php

namespace App\Providers;

use Exception;
use App\Models\Blogs;
use App\Models\Product;
use App\Models\AppModule;
use App\Models\VendorType;
use App\Models\DeliveryZone;
//use Auth
use Illuminate\Http\Request;
//use DB
use App\Rules\ValidPhoneNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use anlutro\LaravelSettings\Facades\Setting;
use App\Models\Category;
use App\Services\CustomDatabaseSettingStore;
use App\Services\Core\ExtraPhoneNumberValidationService;
use Propaganistas\LaravelPhone\Rules\Phone as CustomPhoneRule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

        Validator::includeUnvalidatedArrayKeys();
        Schema::defaultStringLength(191);

        view()->composer(['livewire.website.modals.location','livewire.website.layouts.partials.header'], function ($view) use ($request){
            $view->with('deliveryzones', DeliveryZone::getdeliveryzone($request));
        });

        view()->composer(['livewire.website.section.blogs'], function ($view) use ($request){
            $view->with('blogs', Blogs::getblogs($request));
        });

        view()->composer(['livewire.website.layouts.partials.header','livewire.website.layouts.partials.footer'], function ($view) use ($request){
            $view->with('vendortypes', VendorType::get_vendor_types($request));
            $view->with('categoriesWithSubcategories', Category::get_category_wise_subcategory($request));

            $moduleConfig = AppModule::first();

            // Check if moduleConfig exists
            if ($moduleConfig) {
                // Check module type and pass appropriate value to the view
                $moduleType = ($moduleConfig->module_type == 'single') ? 'single' : 'multi';
                $view->with('check_module_type', $moduleType);
            } else {
                // If no AppModule is found, default to 'multi'
                $view->with('check_module_type', 'multi');
            }

        });


       // RealEstate
        view()->composer(['livewire.website.section.realestate'], function ($view) use ($request){
            $view->with('realestates', Product::get_realestate($request));
        });

        // E-commerce
        view()->composer(['livewire.website.section.product'], function ($view) use ($request){
            $view->with('ecommerces', Product::get_ecommerce($request));
        });

        // Services
        view()->composer(['livewire.website.section.service'], function ($view) use ($request){
            $view->with('services', Product::get_services($request));
        });

        view()->composer(['layouts.partials.nav.menu'], function ($view) {
            // Retrieve the first AppModule and the related VendorType
            $moduleConfig = AppModule::first();
            if ($moduleConfig) {
                $vendorType = VendorType::find($moduleConfig->vendor_types_id);
                if ($vendorType) {
                    // Pass the slug to the view
                    $view->with('sidebar_filter', $vendorType->slug);
                } else {
                    $view->with('sidebar_filter', 'default-slug');  // fallback if vendorType is not found
                }
            } else {
                $view->with('sidebar_filter', 'default-slug');  // fallback if moduleConfig is not found
            }
        });

        view()->composer(['layouts.partials.nav.desktop','layouts.partials.nav.mobile'], function ($view) {
            // Retrieve the first AppModule and the related VendorType
            $moduleConfig = AppModule::first();

            // Check if moduleConfig exists
            if ($moduleConfig) {
                // Check module type and pass appropriate value to the view
                $moduleType = ($moduleConfig->module_type == 'single') ? 'single' : 'multi';
                $view->with('check_module_type', $moduleType);
            } else {
                // If no AppModule is found, default to 'multi'
                $view->with('check_module_type', 'multi');
            }
        });


        //test db connection
        $isDBConnected = false;
        try {
            $isDBConnected = DB::connection()->getPdo() ? true : false;
        } catch (Exception $ex) {
            $isDBConnected = false;
        }
        //
        if (!app()->runningInConsole()) {
            //
            try {
                if ($isDBConnected && !Schema::hasTable('settings')) {
                    $currentRoute = $this->app->request->getRequestUri();
                    if (!str_contains($currentRoute, "/install")) {
                        redirect("install")->send();
                    }
                }
            } catch (Exception $ex) {
                //
                $currentRoute = $this->app->request->getRequestUri();
                if (!str_contains($currentRoute, "/install")) {
                    redirect("install")->send();
                }
            }
        }

        try {
            if ($isDBConnected && Schema::hasTable('settings')) {
                date_default_timezone_set(setting('timeZone', 'UTC'));
                // app()->setLocale(setting('localeCode', 'en'));
            } else {
                date_default_timezone_set('UTC');
                // app()->setLocale('en');
            }
        } catch (Exception $ex) {
            //
            date_default_timezone_set('UTC');
            // app()->setLocale('en');
        }



        if (!$this->app->environment('production')) {
            try {
                $supportEmails = config('backend.support.email');
                $isHostSet = config('mail.host') != null;
                if ($isHostSet && !empty($supportEmails)) {
                    Mail::alwaysTo($supportEmails);
                }
            } catch (\Exception $ex) {
                logger("Mail Always to Error", [$ex]);
            }
        }



        ///
        //
        Blade::if('showPackage', function () {

            $user = Auth::user();
            $isParcel = $user->vendor->vendor_type->is_parcel ?? false;

            //
            if ($user && ($user->hasAnyRole('admin') || ($user->hasAnyRole('manager') && $isParcel))) {
                return 1;
            }
            return 0;
        });
        //
        Blade::if('showService', function () {

            $user = Auth::user();
            $isService = $user->vendor->vendor_type->is_service ?? false;

            //
            if ($user && ($user->hasAnyRole('admin') || ($user->hasAnyRole('manager') && $isService))) {
                return 1;
            }
            return 0;
        });
        //
        Blade::if('showProduct', function () {

            $user = Auth::user();
            $isParcel = $user->vendor->vendor_type->is_parcel ?? false;
            $isService = $user->vendor->vendor_type->is_service ?? false;
            $hasVendor = $user->vendor != null ?? false;

            //
            if ($user && ($user->hasAnyRole('admin') || (!$isParcel && !$isService && $hasVendor))) {
                return 1;
            }
            return 0;
        });
        //
        Blade::if('showDeliveryBoys', function () {

            $user = Auth::user();
            $showDeliveryBoysMenu = $user->vendor->has_drivers ?? false;

            //
            if ($user && $user->hasAnyRole('manager') && $showDeliveryBoysMenu) {
                return 1;
            }
            return 0;
        });
        //
        Blade::if('handleDeliveryBoys', function () {
            $user = Auth::user();
            $showDeliveryBoysMenu = $user->vendor->has_drivers ?? false;

            //
            if ($user->hasAnyRole('admin|city-admin')) {
                return 1;
            }
            //
            if ($user && $user->hasAnyRole('manager') && $showDeliveryBoysMenu) {
                return 1;
            }
            return 0;
        });

        //
        Blade::if('showDeliveryFeeSetting', function () {

            $user = Auth::user();
            if (setting('vendorSetDeliveryFee') || $user->hasAnyRole('admin')) {
                return 1;
            }
            //if the user is manager and vendor has own drivers
            if ($user && $user->hasAnyRole('manager') && ($user->vendor->has_drivers ?? false)) {
                return 1;
            }
            return 0;
        });

        //add if manager active vendor is parcel - showNewParcelOrder
        Blade::if('showNewParcelOrder', function () {

            $user = Auth::user();
            if ($user == null || !$user->hasAnyRole('manager')) {
                return 0;
            }

            $isParcel = $user->vendor->vendor_type->is_parcel ?? false;
            if ($isParcel) {
                return 1;
            }
            return 0;
        });


        Validator::extendDependent('phone', function ($attribute, $value, $parameters, $validator) {
            //first check
            $passed = (new CustomPhoneRule())->setValidator($validator)->passes($attribute, $value);
            //check if the validator rule has failed
            if (!$passed) {
                //trim spaces
                $value = str_replace(" ", "", $value);
                $passed = ExtraPhoneNumberValidationService::validateCustomRegex($value);
                return $passed;
            }
            return true; // If all checks pass, return true
        });

        //force queue:restart after saving settings
        Setting::extend('customDatabaseSettingStore', function ($app) {
            return $app->make(CustomDatabaseSettingStore::class);
        });
    }
}
