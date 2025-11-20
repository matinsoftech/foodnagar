<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorType;

class SubscriptionPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_type_id',
        'name',
        'description',
        'is_free',
        'amount',
        'days',
        'photo'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function vendorType()
    {
        return $this->belongsTo(VendorType::class, 'vendor_type_id', 'id');
    }

    protected $casts = [
        'vendor_type_id' => 'array', // JSON automatically decoded to array
        'is_free' => 'boolean',
    ];

    public function getVendorTypesAttribute()
    {
        if (!$this->vendor_type_id) return [];

        return VendorType::whereIn('id', $this->vendor_type_id)
            ->pluck('name')
            ->toArray();
    }

    public function purchases()
    {
        return $this->hasMany(SubscriptionPurchase::class);
    }
}
