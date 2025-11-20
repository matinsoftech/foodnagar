<?php

namespace App\Http\Livewire\Settings;

use Exception;

class WebAppSettings extends BaseSettingsComponent
{



    // App settings
    public $maxScheduledDay;
    public $vendor_slot_interval;
    public $maxScheduledTime;
    public $minScheduledTime;
    public $autoCancelPendingOrderTime;
    public $defaultVendorRating;
    public $vendorResetOpenCloseTime;
    //
    public $productDetailsUpdateRequest;
    public $verification_type;
    public $subscription_mode;
    public $free_first_delivery;
    public $enable_cart_on_layout;


    public function mount()
    {
        $this->appSettings();
    }

    public function render()
    {
        return view('livewire.settings.web-app-settings');
    }




    //App settings
    public function appSettings()
    {
        $this->maxScheduledDay = setting('maxScheduledDay', 5);
        $this->vendor_slot_interval = (int) setting('vendor_slot_interval', 60);
        $this->maxScheduledTime = setting('maxScheduledTime', 2);
        $this->minScheduledTime = setting('minScheduledTime', 2);
        $this->autoCancelPendingOrderTime = setting('autoCancelPendingOrderTime', 30);
        $this->defaultVendorRating = setting('defaultVendorRating', 5);
        $this->vendorResetOpenCloseTime = setting('vendorResetOpenCloseTime', 2);
        $this->productDetailsUpdateRequest = (bool) setting('productDetailsUpdateRequest', 0);
        $this->verification_type = setting('verification_type', '');
        $this->subscription_mode = setting('subscription_mode', 'off');
        $this->free_first_delivery = setting('free_first_delivery', 'off');
        $this->enable_cart_on_layout = setting('enable_cart_on_layout', 'off');
    }

    public function saveAppSettings()
    {

        $this->validate([
            'vendor_slot_interval' => "required|min:5|numeric"
        ]);

        try {

            $this->isDemo();



            $appSettings = [
                'maxScheduledDay' =>  $this->maxScheduledDay,
                'vendor_slot_interval' =>  $this->vendor_slot_interval,
                'maxScheduledTime' =>  $this->maxScheduledTime,
                'minScheduledTime' =>  $this->minScheduledTime,
                'autoCancelPendingOrderTime' =>  $this->autoCancelPendingOrderTime,
                'defaultVendorRating' =>  $this->defaultVendorRating,
                'vendorResetOpenCloseTime' =>  $this->vendorResetOpenCloseTime,
                'productDetailsUpdateRequest' =>  (int) $this->productDetailsUpdateRequest,
                'verification_type' =>  $this->verification_type,
                'subscription_mode' =>  $this->subscription_mode,
                'free_first_delivery' =>  $this->free_first_delivery,
                'enable_cart_on_layout' =>  $this->enable_cart_on_layout
            ];

            // update the site name
            setting($appSettings)->save();

            $this->showSuccessAlert(__("App Settings saved successfully!"));
            $this->goback();
        } catch (Exception $error) {
            $this->showErrorAlert($error->getMessage() ?? __("App Settings save failed!"));
        }
    }
}
