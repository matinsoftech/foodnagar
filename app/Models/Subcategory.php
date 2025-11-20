<?php

namespace App\Models;

use Kirschbaum\PowerJoins\PowerJoins;
use App\Traits\HasTranslations;

class Subcategory extends BaseModel
{
    use PowerJoins;
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_subcategory', 'subcategory_id', 'product_id');
    }

    public function sub_sub_categories()
    {
        return $this->hasMany(SubSubCategory::class, 'sub_category_id');
    }
}
