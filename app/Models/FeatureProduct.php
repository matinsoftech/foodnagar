<?php

namespace App\Models;

class FeatureProduct extends BaseModel
{
    protected $table = 'feature_product_section';
    protected $guarded = [];
    
    protected $casts = [
        'product_id' => 'array', // auto converts JSON <-> array
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id', 'product_id');
    }

}