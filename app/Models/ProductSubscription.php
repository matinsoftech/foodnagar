<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductSubscription extends NoDeleteBaseModel
{
    protected $table = 'product_subscriptions';
    protected $fillable = ['product_id', 'startDay', 'endDay', 'price'];
    public $timestamps = false;
}
