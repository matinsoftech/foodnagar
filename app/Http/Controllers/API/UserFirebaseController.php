<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFirebaseController extends Controller
{
    //
    public function syncTokens(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $user->syncFCMTokens($request->tokens ?? null);
            return response()->json([
                "message" => __("Token synced successfully"),
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage() ?? __("Token sync failed"),
            ], 400);
        }
    }

    public function updateLatLong(Request $request)
    {
        if(!$request->latitude || !$request->longitude){
            return response()->json([
                "message" => __("Please provide latitude and longitude"),
            ]);
        }
        try {
            $user = User::find(Auth::id());
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->save();
            return response()->json([
                "message" => __("Location updated successfully"),
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage() ?? __("Location update failed"),
            ], 400);
        }
    }

    public function setAvailable(Request $request)
    {
        $request->validate([
            'available' => 'required|boolean',
        ]);

        $user = User::whereId(Auth::id())->first();
        $user->available = $request->available;
        $user->save();
        return response()->json([
            "message" => __("Status updated successfully"),
        ], 200);
    }
}
