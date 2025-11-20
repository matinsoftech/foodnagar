<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = "shipping_addresses";
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address1',
        'address2',
        'main_address',
        'city',
        'country',
        'state',
        'zipcode',
        'business_name',
        'default_status',
    ];
}
