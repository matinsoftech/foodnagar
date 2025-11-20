<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testinomial extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table= "testinomials";

    protected $fillable = [
        'name',
        'designation',
        'description',
        'is_active',
        'slug'
    ];
}
