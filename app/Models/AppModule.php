<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_type',
        'vendor_types_id',
        'vendor_type',
        'vendor_id'
    ];

    public function hasvendorType()
    {
        return $this->belongsTo(VendorType::class,'vendor_types_id');
    }
    public function hasvendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
