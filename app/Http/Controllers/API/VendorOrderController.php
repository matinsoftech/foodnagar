<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CouponUser;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function vendorCustomers(Request $request)
    {
        $vendorOrderCustomers = Order::where('vendor_id',auth()->user()->vendor_id)->pluck('user_id')->toArray();
        $customers = User::whereIn('id', $vendorOrderCustomers)->get();
        return response()->json(['status'=>'success','data'=>$customers]);
    }

    public function generateOrder(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'coupon_code' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Create new order
            $order = new Order();
            $order->vendor_id = Auth::id();
            if($request->is_guest == 1){
                $order->is_guest = 1;
                $order->guest_name = $request->guest_name;
                $order->guest_email = $request->guest_email;
                $order->guest_phone = $request->guest_phone;
            }else{
                $order->user_id = $request->user_id;
            }
            $order->payment_method_id = $request->payment_method_id;
            $order->tip = $request->tip;
            $order->note = $request->note;
            $order->delivery_address_id = $request->delivery_address_id;

            $order->status = "pending";
            $order->total_price = 0; 
            $order->save();

            $totalPrice = 0;

            foreach ($request->products as $newOrderProductData) {
                $product = Product::findOrFail($newOrderProductData['product_id']);

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->quantity = $newOrderProductData['qty'] ?? 1;
                $orderProduct->price = ($product->discount_price > 0) ? $product->discount_price : $product->price;
                $orderProduct->product_id = $product->id;

                // Process product options
                $productOptionsString = "";
                $productOptionsIds = "";

                if (!empty($newOrderProductData['selected_options'])) {
                    $productOptions = is_string($newOrderProductData['selected_options']) 
                        ? json_decode($newOrderProductData['selected_options'], true) 
                        : $newOrderProductData['selected_options'];

                    foreach ($productOptions as $key => $productOption) {
                        $productOptionsString .= $productOption['name'] . ', ';
                        $productOptionsIds .= $productOption['id'] . ', ';
                    }

                    $productOptionsString = rtrim($productOptionsString, ', ');
                    $productOptionsIds = rtrim($productOptionsIds, ', ');
                }

                $orderProduct->options = $productOptionsString;
                $orderProduct->options_ids = $productOptionsIds;
                $orderProduct->save();

                // Reduce product stock
                if (!empty($product->available_qty)) {
                    $product->available_qty -= $orderProduct->quantity;
                    $product->save();
                }

                // Update total order price
                $totalPrice += $orderProduct->price * $orderProduct->quantity;
            }

            // Apply coupon if available
            if ($request->coupon_code) {
                $coupon = Coupon::where("code", $request->coupon_code)->first();
                if ($coupon) {
                    CouponUser::create([
                        'coupon_id' => $coupon->id,
                        'user_id' => Auth::id(),
                        'order_id' => $order->id,
                    ]);
                }
            }

            // Update order price
            $order->total_price = $totalPrice;
            $order->updated_at = now();
            $order->save();

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
            ], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'message' => 'Order placement failed!',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::select('id','name','slug')->where('is_active', 1)->get();
        return response()->json(['status'=>'success','data'=>$paymentMethods]);
    }
}
