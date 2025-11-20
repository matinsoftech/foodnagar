<?php

namespace App\Models;


class OrderService extends NoDeleteBaseModel
{

    protected $with = ['service'];

    protected $table = 'order_services';

    protected $fillable= [
        'hours',
        'day',
        'month',
        'year',
        'price',
        'order_id',
        'service_id'
    ];
    
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Service', 'service_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id')->withTrashed();
    }


}

