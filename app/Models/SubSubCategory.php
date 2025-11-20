<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategory extends Model
{
    use HasFactory;
    use PowerJoins;
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'id','name', 'category_id', 'sub_category_id','is_active',' in_order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'sub_category_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_sub_sub_category', 'sub_sub_category_id', 'product_id');
    }



}
