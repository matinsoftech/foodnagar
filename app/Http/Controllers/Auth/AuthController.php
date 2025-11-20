<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validate the input for login
        $credentials = $request->validate([
            'login' => 'required', // This will hold either email or phone number
            'password' => 'required',
        ]);

       // Determine if the login input is an email or phone number
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // // Add +977 prefix if it's a phone number and doesn't already start with it
        // if ($loginField === 'phone' && !str_starts_with($credentials['login'], '+977')) {
        //     $credentials['login'] = '+977' . ltrim($credentials['login'], '0'); // Remove leading 0 if present
        // }
        // Find the user by email or phone
        $user = User::where($loginField, $credentials['login'])->first();

        if ($user) {

            if (!$user->hasRole('client')) {
                return response()->json([
                    'message' => 'Access denied. Only clients are allowed to login.',
                    'status' => 'error',
                ], 403); // Forbidden
            }
            // Check if phone is verified
            if ($user->phone_verified_at === null) {
                return response()->json([
                    'message' => 'Your phone number is not verified.',
                    'status' => 'error', // Optional field to indicate error type
                ], 403); // Forbidden
            }

            // Attempt login if the phone is verified
            if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful!',
                    'user' => $user,
                    'redirect_url' => url('/'),
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Invalid credentials!',
                ], 401); // Unauthorized
            }
        } else {
            return response()->json([
                'message' => 'User not found!',
            ], 404); // Not found
        }
    }


    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }

    public function register(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|max:15|unique:users,phone',
            'password' => 'required|string|min:8',
            'referral_code' => 'nullable|string|max:255',
        ]);


        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'country_code'=> 'NP',
            'password' => Hash::make($validatedData['password']),
            'referral_code' => $validatedData['referral_code'] ?? null,
        ]);

        $user->assignRole('client');


        $url = route('otp.send');
        $response = Http::post($url, [
            "phone" => $user->phone,
            "is_login" => false
        ]);

        if ($response->successful()) {
            return response()->json([
                'success'=>true,
                'message' => 'Registration successful!',
                'user' => $user,
                // 'url' => url('/verify-phone?user_id=') . $user->id
            ], 201);
        }

        // return response()->json([
        //     'success'=>true,
        //     'message' => 'Registration successful!',
        //     'user' => $user
        // ], 201);
    }

    public function sendOtp(Request $request){
        $request->validate([
            "phone" => "required|exists:users,phone",
        ]);

        //firebase
        if ($this->isFirebaseOTP()) {
            // $this->emit('sendOTP', $request->phone);
        } else {

            //http
            $url = route('otp.send');
            $response = Http::post($url, [
                "phone" => $request->phone,
                "is_login" => false
            ]);
            $msg = $response->json()['message'] ?? null;
            //
            if ($response->successful()) {
                return response()->json([
                    "success" => true,
                    "message" => $msg ?? __("OTP sent to your phone number"),
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => $msg ?? __("OTP failed to send to provided phone number"),
                ]);
            }
        }
    }

    public function verifyPhone(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        return view('auth.verify_phone',compact('user'));
    }

    public function authVerifyPhone(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            "otp" => "required|size:6"
        ]);

        //firebase
        if ($this->isFirebaseOTP()) {
            // $this->emit('verifyFirebaseAuth', $this->otp);
        } else {
            $user = User::find($request->user_id);

            //http
            $url = route('otp.verify');
            $response = Http::post($url, [
                "phone" => $user->phone,
                "code" => $request->otp,
                "is_login" => false
            ]);
            $msg = $response->json()['message'] ?? null;

            if ($response->successful()) {
                $user->is_active = 1;
                $user->phone_verified_at = now();
                $user->save();
                $vendor = Vendor::where('id', $user->vendor_id)->first();
                if($vendor){
                    $vendor->is_active = 1;
                    $vendor->save();
                }
                Auth::login($user);
                return response()->json([
                    "success" => true,
                    "message" => $msg ?? __("Account verification successful"),
                    "redirect_url" => route('welcome')
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => $msg ?? __("OTP verification failed"),
                ]);
            }
        }

    }

    public function verifyOtp(Request $request){

        $request->validate([
            "otp" => "required|size:6"
        ]);

        //firebase
        if ($this->isFirebaseOTP()) {
            // $this->emit('verifyFirebaseAuth', $this->otp);
        } else {

            //http
            $url = route('otp.verify');
            $response = Http::post($url, [
                "phone" => $request->phone,
                "code" => $request->otp,
                "is_login" => false
            ]);
            $msg = $response->json()['message'] ?? null;
            //
            if ($response->successful()) {
                $token = Str::random(60);
                session()->put('token', $token);
                return response()->json([
                    "success" => true,
                    "message" => $msg ?? __("OTP verification successful"),
                    "token" => $token
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => $msg ?? __("OTP verification failed"),
                ]);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            "phone" => "required|exists:users,phone",
            "password" => 'required|min:6',
            "password_confirmation" => 'required|same:password|min:6',
        ]);

        if ($request->token == session()->get('token')) {
            session()->forget('token');
            $user = User::where('phone', $request->phone)->first();
            $user->password = Hash::make($request->password);
            $user->Save();

            return response()->json([
                "success" => true,
                "message" => __("Account password updated. You can now login with the newly created account password"),
            ]);
        }else{
            return response()->json([
                "success" => false,
                "message" => __("Invalid token"),
            ]);
        }
    }

    public function isFirebaseOTP()
    {
        $otpGateway = setting('otpGateway');
        $otpGateway = strtolower($otpGateway);
        return $otpGateway == "firebase";
    }
}
