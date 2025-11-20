<?php

namespace App\Models;


class FlashSale extends NoDeleteBaseModel
{


    public function items()
    {
        return $this->hasMany('App\Models\FlashSaleItem');
    }

    public function vendor_type()
    {
        return $this->belongsTo('App\Models\VendorType');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id')->withTrashed();
    }

    public function scopeNotExpired($query)
    {
        return $query->where('expires_at', '>', \Carbon\Carbon::now());
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function favourite()
    {
        return $this->belongsTo('App\Models\Favourite', 'id', 'product_id')->where("user_id", "=", auth('sanctum')->user()->id ?? 0);
    }

    public function favourites()
    {
        return $this->belongsTo('App\Models\Favourite', 'id', 'product_id');
    }
    public function FlashSaleItem()
    {
        return $this->hasMany(FlashSaleItem::class, 'flash_sale_id');
    }
    // public function itemable()
    // {
    //     return $this->morphTo();
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
}

