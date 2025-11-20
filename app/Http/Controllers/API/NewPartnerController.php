<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class NewPartnerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'message' => 'nullable|string',
        ]);

        $partner = Partner::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Your form has been submitted successfully. One of our representatives will get in touch with you shortly.',
            'data' => $partner,
        ], 201);
    }
}
