<?php

namespace App\Models;

use Illuminate\Http\Request;
use Kirschbaum\PowerJoins\PowerJoins;
use Malhal\Geographical\Geographical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryZone extends NoDeleteBaseModel
{
    use HasFactory;
    use PowerJoins;
    use Geographical;
    protected static $kilometers = true;


    public function points()
    {
        return $this->hasMany('App\Models\DeliveryZonePoint');
    }

    public function vendors()
    {
        return $this->belongsToMany('App\Models\Vendor');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function scopeCloseTo($query, $latitude, $longitude)
    {
        return $query
            ->selectRaw('radius AS deliveryZoneRange')
            ->distance($latitude, $longitude)
            ->havingRaw("deliveryZoneRange >= distance")->orderBy('distance', 'ASC');
    }

    public static function getdeliveryzone(Request $request){
        return DeliveryZone::where('is_active', true)
                    ->orderBy('id', 'DESC')
                    ->get();
    }
}
