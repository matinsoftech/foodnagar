<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'age',
        'gender',
        'identity_proof',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
