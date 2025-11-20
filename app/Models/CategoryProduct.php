<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = "category_product";

    protected $fillable = [
        'category_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relationship to the Category model.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
