<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Traits\HasTranslations;
use Illuminate\Support\Facades\Auth;
use App\Traits\ProductAttributeTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Traits\ModelTokenizedAttributeTrait;


class UserProductInfo extends BaseModel
{
    protected $table = 'product_user_info';

    protected $fillable = [
        'user_id',
        'product_id',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
