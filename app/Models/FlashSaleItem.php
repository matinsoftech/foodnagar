<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlashSaleItem extends Model
{
    use HasFactory;
    // public function item()
    // {
    //     return $this->morphTo();
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    
}
