<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Traits\HasTranslations;
use Illuminate\Support\Facades\Auth;
use App\Traits\ProductAttributeTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Traits\ModelTokenizedAttributeTrait;


class Product extends BaseModel
{
    use PowerJoins;
    use ProductAttributeTrait;
    use HasTranslations;
    use ModelTokenizedAttributeTrait;
    public $translatable = ['name', "description"];

    /*protected $fillable = [
        "id",
        "feature_status",
        "name",
        "description",
        "price",
        "discount_price",
        "capacity",
        "unit",
        "package_count",
        "available_qty",
        "featured",
        "deliverable",
        "is_active",
        "vendor_id",
        "vendor_type_id"
    ];*/

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'discount_price',
        'capacity',
        'unit',
        'package_count',
        'available_qty',
        'featured',
        'deliverable',
        'is_active',
        'vendor_id',
        'vendor_type_id',
        'province_id',
        'district_id',
        'city_id',
        'ad_type',
        'category_id',
        'user_approve',
        'brand_id',
    ];


    protected $appends = ['formatted_date', 'sell_price', 'photo', 'is_favourite', 'rating', 'option_groups', 'photos', 'digital_files', 'token', 'brand_id'];
    protected $with = ['vendor', 'tags'];
    protected $withCount = ['reviews'];
    protected $casts = [
        'age_restricted' => "bool",
    ];

    public function scopeActive($query)
    {
        $query->where('is_active', 1)->whereHas('vendor', function ($q) {
            $q->where('is_active', 1);
        });

        //check if products table has approved column
        if (\Schema::hasColumn('products', 'approved')) {
            $query->where('approved', 1);
        }

        //
        return $query;
    }

    // public function getFinalPriceAttribute()
    // {
    //     $price = $this->price;

    //     // If product belongs to a vendor and vendor discount is active
    //     if ($this->vendor && $this->vendor->discount_active) {
    //         return $this->vendor->applyDiscount($price);
    //     }

    //     return $price;
    // }


    public function scopeMine($query)
    {

        return $query->when(Auth::user()->hasRole('manager'), function ($query) {
            return $query->where('vendor_id', Auth::user()->vendor_id);
        })->when(Auth::user()->hasRole('city-admin'), function ($query) {
            return $query->whereHas("vendor", function ($query) {
                return $query->where('creator_id', Auth::id());
            });
        });
    }


    // RELATIONSHIPS
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id', 'id')->withTrashed();
    }

    public function vendor_types()
    {
        return $this->belongsTo('App\Models\VendorType', 'vendor_type_id', 'id');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\VendorType');
    }


    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function userInfo()
    {
        return $this->hasOne(UserProductInfo::class, 'product_id', 'id');
    }

    // Media handling for images (if you're using a package like Spatie Media Library)
    /*public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        // Replace with the actual method to get media URL if you're using a media package
        return optional($this->getMedia($collectionName)->first())->getUrl($conversion);
    }*/

    public function sub_categories()
    {
        return $this->belongsToMany(Subcategory::class, 'product_subcategory', 'product_id', 'subcategory_id');
    }
    public function sub_sub_categories()
    {
        return $this->belongsToMany(SubSubCategory::class, 'product_sub_sub_category', 'product_id', 'sub_sub_category_id');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Models\Menu');
    }

    public function options()
    {
        return $this->belongsToMany('App\Models\Option');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function option_groups()
    {
        // return $this->hasManyThrough(
        //     OptionGroup::class,
        //     ProductOption::class,
        //     'product_id', // Foreign key on the Option table...
        //     'id', // Foreign key on the OptionGroup table...
        //     'id', // Local key on the product table...
        //     'option_group_id' // Local key on the Option table...
        // )->groupBy('id');
    }




    public function sales()
    {
        return $this->hasMany('App\Models\OrderProduct', 'product_id', 'id');
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\OrderProduct')->whereHas(
            "order",
            function ($query) {
                return $query->where("user_id",  auth('sanctum')->user()->id);
            }
        );
    }

    public function favourite()
    {
        return $this->belongsTo('App\Models\Favourite', 'id', 'product_id')->where("user_id", "=", auth('sanctum')->user()->id ?? 0);
    }

    public function favourites()
    {
        return $this->belongsTo('App\Models\Favourite', 'id', 'product_id');
    }


    //attribute getters
    public function getOptionGroupsAttribute()
    {

        $optionGroupIds = Option::whereHas('products', function ($query) {
            return $query->where('product_id', "=", $this->id);
        })->active()->pluck('option_group_id');
        //
        $models = OptionGroup::with([
            'options' => function ($query) {
                return $query->whereHas('products', function ($query) {
                    return $query->where('product_id', "=", $this->id);
                });
            }
        ])
            ->whereIn('id', $optionGroupIds)
            ->active()
            ->get();
        return $models;
    }

    public function getHasOptionsAttribute()
    {
        return $this->options()->count() > 0;
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id');
    }

    public function productSubscription()
    {
        return $this->hasMany('App\Models\ProductSubscription', 'product_id', 'id');
    }

    public function getRatingAttribute()
    {
        return  (float) $this->reviews()->avg('rating');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getIsFavouriteAttribute()
    {

        if (auth('sanctum')->user()) {
            return $this->favourite ? true : false;
        } else {
            return false;
        }
    }



    // public function getSellPriceAttribute()
    // {
    //     return ($this->discount_price != null && $this->discount_price > 0) ? $this->discount_price : $this->price;
    // }

    public function getSellPriceAttribute()
    {
        // 1. Product-level discount always wins
        // if (!empty($this->discount_price) && $this->discount_price > 0) {
        //     return $this->discount_price;
        // }

        // 2. Vendor-level discount applies automatically
        if ($this->vendor && $this->vendor->discount_active) {
            return $this->vendor->applyDiscount($this->price);
        }

        // 3. No discount – return original price
        return $this->price;
    }
    public function getFinalPriceAttribute()
    {
        return $this->sell_price;
    }


    public function getBrandIdAttribute($value)
    {
        return $value;
    }

    public function getPhotosAttribute()
    {
        $mediaItems = $this->getMedia('default');
        $photos = [];

        foreach ($mediaItems as $mediaItem) {
            array_push($photos, $mediaItem->getFullUrl());
        }
        return $photos;
    }

    public function hasTag($tagId)
    {
        return $this->tags()->where('tag_id', $tagId)->exists();
    }

    //
    public function getRatingSummaryAttribute()
    {
        if (!\Schema::hasTable('product_reviews')) {
            return;
        }
        $rates = [5, 4, 3, 2, 1];
        $summary = [];
        $totalReviews = ProductReview::where('product_id', $this->id)->count();
        //
        foreach ($rates as $rate) {
            $rateCount = ProductReview::where('product_id', $this->id)->where("rating", $rate)->count();
            $summary[] = [
                "count" => $rateCount,
                "percentage" => $totalReviews <= 0 ? 0 : ((($rateCount / $totalReviews) * 100) ?? 0),
                "rate" => $rate,
            ];
        }
        //
        return $summary;
    }

    // E-commerece
    public static function get_few_products(Request $request)
    {
        return   Product::with('vendor', 'categories', 'favourites')
            ->whereHas('vendor', function ($query) {
                $query->where('vendor_type_id', 8);
            })
            ->limit(5)->get();
    }

    public static function get_all_products(Request $request)
    {
        return   Product::with('vendor', 'categories', 'favourites')
            ->whereHas('vendor', function ($query) {
                $query->where('vendor_type_id', 8);
            })
            ->get();
    }
    //End E-commerece

    // RealEstate
    public static function get_realestate(Request $request)
    {
        return   Product::with('vendor', 'categories', 'favourites')
            ->whereHas('vendor', function ($query) {
                $query->where('vendor_type_id', 9);
            })
            ->limit(3)->get();
    }

    // E-commerece
    public static function get_ecommerce(Request $request)
    {
        return   Product::with('vendor', 'categories', 'favourites')
            ->whereHas('vendor', function ($query) {
                $query->where('vendor_type_id', 8);
            })
            ->limit(6)->get();
    }


    // Service
    public static function get_services(Request $request)
    {
        return   Product::with('vendor', 'categories', 'favourites')
            ->whereHas('vendor', function ($query) {
                $query->where('vendor_type_id', 5);
            })
            ->limit(3)->get();
    }
}
