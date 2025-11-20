<?php

namespace App\Models;

class Favourite extends BaseModel
{

    protected $table = "favourites";
    protected $fillable =[
        'user_id',
        'product_id',
        'service_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


}
