<?php

namespace App\Models;

use App\Models\VendorType;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blogs extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'id', 'is_active', 'title', 'description','vendortype_id'
    ];

    public function module(){
        return $this->belongsTo(VendorType::class,'vendortype_id','id');
    }

    public static function getblogs(Request $request){
       return  Blogs::with('module')->where('is_active',1)->get();
    }
}
