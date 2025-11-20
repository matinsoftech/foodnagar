<?php

namespace App\Http\Controllers\Livewire;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\MessageDetail;
use App\Http\Controllers\Controller;
use App\Traits\FirebaseMessagingTrait;

class ChattingController extends Controller
{
    use FirebaseMessagingTrait;

    public function messages()
    {

        $messages = Message::with('vendor', 'user')->where('vendor_id',auth()->user()->id)->latest()->get();

        // Check if there are any messages before accessing the first one
        $firstVendorId = $messages->first() ? $messages->first()->user_id : null;

        // Ensure $firstVendorId is not null before querying
        $chatMessages = $firstVendorId
            ? MessageDetail::with('user','vendor')->where('vendor_id', auth()->user()->id)
                        ->where('user_id', $firstVendorId)
                        ->get()
            : collect();

        $authImage = auth()->user()->photo;
        $vendorImage = $messages->first() ? $messages->first()->user->photo ?? asset('images/user.png') : asset('images/user.png');

        return view('livewire.message.message', compact('messages', 'chatMessages', 'authImage', 'vendorImage'));
    }

    public function sendMessage(Request $request)
    {
        $message = new MessageDetail();
        $message->vendor_id = auth()->user()->id;
        $message->user_id = $request->vendor_id;
        $message->sender_id = auth()->user()->id;
        $message->message = $request->message;
        $message->save();

        $topic = str_ireplace("vendor_", "v_", $request->vendor_id);
        $title = "New Message";

        $user = User::select('id','name')->whereId(auth()->user()->id)->first();
        $user->photo = $user->photo ?? asset('images/user.png');

        $order = Order::where('user_id',auth()->user()->id)->latest()->first();
	if ($order){
        $orderData = [
            'is_chat' => "1",
            'path' => 'orders/'.$order->code.'/customerDriver/chats',
            'user' => $user,
            'peer' => json_encode($user),
            'title' => $title,
            'body' => $request->message,
        ];

        $this->sendOrderFirebaseNotification($topic, $title, $request->message, $orderData);
    }
        // Ensure $firstVendorId is not null before querying
        $chatMessages = $request->vendor_id
            ? MessageDetail::with('user','vendor')->where('vendor_id', auth()->user()->id)
                        ->where('user_id', $request->vendor_id)
                        ->get()
            : collect();

        $authImage = auth()->user()->photo;
        $vendor = User::whereId($request->vendor_id)->first();
        $vendorImage = $vendor->photo ?? asset('images/user.png');

        $view = view('ssr.chat_details',compact('chatMessages','authImage','vendorImage','vendor','message'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }

    public function CustomerMessage(Request $request)
    {
        $vendor = User::whereId($request->vendor_id)->firstOrFail();

        $messages = Message::with('vendor')->where('user_id',auth()->user()->id)->latest()->get();
        $chatMessages = MessageDetail::with('user','vendor')->where('user_id', auth()->user()->id)
                    ->where('vendor_id', $request->vendor_id)
                    ->get();
        $authImage = auth()->user()->photo;
        $vendorImage = $vendor->photo ?? asset('images/user.png');

        $view = view('ssr.chat_details',compact('chatMessages','authImage','vendorImage','vendor','messages'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }
}
