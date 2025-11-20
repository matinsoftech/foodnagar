<?php

namespace App\Models;

use Throwable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomField extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'type',
        'image',
        'required',
        'is_active',
        'values',
        'min_length',
        'max_length',
    ];

    public function customFieldVendorType() {
        return $this->hasMany(CustomFieldVendorType::class, 'custom_field_id');
    }

    public function vendorType()
    {
        return $this->belongsToMany(VendorType::class, 'custom_field_vendor_type', 'custom_field_id', 'vendor_type_id');
    }

    public function getValuesAttribute($value) {
        try {
            return array_values(json_decode($value, true, 512, JSON_THROW_ON_ERROR));
        } catch (Throwable) {
            return $value;
        }
    }

    public function getImageAttribute($image) {
        if (!empty($image)) {
            return url(Storage::url($image));
        }
        return $image;
    }

    public function scopeSearch($query, $search) {
        $search = "%" . $search . "%";
        $query = $query->where(function ($q) use ($search) {
            $q->orWhere('name', 'LIKE', $search)
                ->orWhere('type', 'LIKE', $search)
                ->orWhere('values', 'LIKE', $search)
                ->orWhere('status', 'LIKE', $search)
                ->orWhereHas('categories', function ($q) use ($search) {
                    $q->where('name', 'LIKE', $search);
                });
        });
        return $query;
    }

    public function scopeFilter($query, $filterObject) {
        if (!empty($filterObject)) {
            foreach ($filterObject as $column => $value) {
                if ($column == "category_names") {
                    $query->whereHas('custom_field_category', function ($query) use ($value) {
                        $query->where('category_id', $value);
                    });
                } else {
                    $query->where((string)$column, (string)$value);
                }
            }
        }
        return $query;

    }
}
