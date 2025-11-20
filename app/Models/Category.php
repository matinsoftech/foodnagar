<?php

namespace App\Models;

use Kirschbaum\PowerJoins\PowerJoins;
use App\Traits\HasTranslations;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Category extends BaseModel
{
    use PowerJoins;
    use HasTranslations;
    use WithFileUploads;
    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'vendor_type_id',
        'is_active',
        'category_product_status',
        'banner',
        'priority'
    ];

    protected $casts = [
        'name' => 'array', 
    ];
    protected $with = ['vendor_type'];

    public function vendor_type()
    {
        return $this->belongsTo('App\Models\VendorType', 'vendor_type_id', 'id');
    }

    public function vendors()
    {
        return $this->belongsToMany('App\Models\Vendor');
    }

    /*public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }*/

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }


    public function services()
    {
        return $this->hasOne('App\Models\Service');
    }

    public function sub_categories()
    {
        return $this->hasMany('App\Models\Subcategory');
    }

    public function getHasSubcategoriesAttribute()
    {
        return $this->sub_categories()->exists() ?? false;
    }

    public static function get_category_wise_subcategory(Request $req){
        return Category::with('sub_categories')
                ->where('is_active', true)
                ->get();
    }

    public function scopeInorder($query)
    {
        return $query->orderByRaw('CAST(priority AS UNSIGNED) ASC');
    }
}
