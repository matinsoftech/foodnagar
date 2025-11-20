<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\FeatureProduct;
use App\Models\Product;
use Illuminate\Http\Request;


class BannerController extends Controller
{

    //
    public function index(Request $request)
    {
        return BannerResource::collection(
            Banner::inorder()
                /*
                ->when(
                    $request->vendor_type_id,
                    function ($query) use ($request) {
                        return $query->whereHas('category', function ($query) use ($request) {
                            return $query->active()->where('vendor_type_id', $request->vendor_type_id);
                        })->orWhereHas('vendor', function ($query) use ($request) {
                            return $query->active()->where('vendor_type_id', $request->vendor_type_id);
                        });
                    }
                )
                */
                ->when(
                    $request->vendor_type_id,
                    function ($query) use ($request) {
                        return $query->where('vendor_type_id', $request->vendor_type_id);
                    },
                    function ($query) {
                        return $query->whereNull('vendor_type_id')->orWhere('vendor_type_id', '');
                    }
                )
                ->when(
                    $request->featured,
                    function ($query) {
                        return $query->where('featured', '1');
                    }
                )
                ->active()
                ->get()
        );
    }

    //Show Featrure product for home page with priority wise
    public function featureIndex()
    {
        // Fetch all feature products ordered by priority ascending (or descending)
        $featureProducts = FeatureProduct::orderBy('priority', 'asc')->get();

        // Transform data
        $data = $featureProducts->map(function ($feature) {
            $products = [];
            if(!empty($feature->product_id)){
                $productIds = json_decode($feature->product_id);
                $products = Product::whereIn('id', $productIds)
                                    ->select('id', 'name', 'price') // select fields you need
                                    ->get();
            }

            return [
                'id' => $feature->id,
                'title' => $feature->title,
                'description' => $feature->description,
                'priority' => $feature->priority,
                'products' => $products,
                'created_at' => $feature->created_at->toDateTimeString(),
                'updated_at' => $feature->updated_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Feature Products retrieved successfully',
            'data' => $data
        ]);
    }
}