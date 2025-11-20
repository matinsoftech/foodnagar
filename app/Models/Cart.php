<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "carts";
    protected $fillable =[
        'user_id','product_id','service_id','vendor_id','product_price','quantity','price'
    ];

    public function hasproduct(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function hasService(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
