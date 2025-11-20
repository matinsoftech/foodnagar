<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next, $module)
    {
        // Fetch the vendor type by its slug
        $vendorType = VendorType::where('slug', $module)->first();



        // If vendor type is not found
        if (!$vendorType) {
            abort(404, 'Vendor type is not found.');
        }

        // Fetch the module configuration associated with the vendor type
        $moduleConfig = AppModule::first();

        // If module configuration is not found or inactive
        if (!$moduleConfig) {
            abort(404, 'Module is inactive or not found.');
        }

        // If the module type is 'multi', allow access to all vendor types

        // If the module type is 'single', restrict access to the specific vendor type
        if ($moduleConfig->module_type === 'single') {
            // Check if the user has access to the specific vendor type for this module
            if ($moduleConfig->vendor_types_id == $vendorType->id) {
                return $next($request);
            }else{
                abort(404, 'Page Not Found');
            }
        }

        if ($moduleConfig->module_type === 'multi') {
            return $next($request); // Grant access to all vendor types
        }


    }
}
