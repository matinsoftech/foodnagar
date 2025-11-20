<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\MessageDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\FirebaseMessagingTrait;

class ChatController extends Controller
{
    use FirebaseMessagingTrait;

    public function startChat($vendorId)
    {
        $user = auth()->user();

        // Ensure user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to login to start a chat.');
        }

        // Check if chat already exists
        $existingChat = Message::where('user_id', $user->id)
            ->where('vendor_id', $vendorId)
            ->first();

        if (!$existingChat) {
            // Create a new chat if it doesn't exist
            $newChat = new Message();
            $newChat->user_id = $user->id;
            $newChat->vendor_id = $vendorId;
            // dd($newChat);
            $newChat->save();
        }

        // Fetch messages
        $messages = Message::with('vendor')->where('user_id', $user->id)->latest()->get();

        // Ensure vendor_id is set correctly
        $firstVendorId = $vendorId ?? $user->vendor_id;

        // If vendor_id is still null, get the first vendor from the table
        if (!$firstVendorId) {
            $firstVendorId = DB::table('vendors')->first()?->id;
        }

        // Redirect to message page with vendor_id
        return redirect()->route('message')->with('vendor_id', $firstVendorId);
    }



    public function messages()
    {
        // $authImage = auth()->user()->id;
        // dd($authImage);
        $messages = Message::with('vendor')->where('user_id', auth()->user()->id)->latest()->get();

        // Check if there are any messages before accessing the first one
        $firstVendorId = $messages->first() ? $messages->first()->vendor_id : null;

        // Ensure $firstVendorId is not null before querying
        // $chatMessages = $firstVendorId

        //     ? MessageDetail::with('user', 'vendor')->where('user_id', auth()->user()->id)

        //     ? MessageDetail::with('user', 'vendor')
        //     ->where('user_id', $user->id)


        // Ensure $firstVendorId is not null before querying
        $chatMessages = $firstVendorId
            ? MessageDetail::with('user', 'vendor')->where('user_id', auth()->user()->id)

            ->where('vendor_id', $firstVendorId)
            ->get()
            : collect();
        // dd($chatMessages);
        $authImage = auth()->user()->photo;
        $vendorImage = $messages->first() ? $messages->first()->vendor->photo ?? asset('images/user.png') : asset('images/user.png');

        return view('livewire.website.user-profile.message', compact('messages', 'chatMessages', 'authImage', 'vendorImage', 'firstVendorId'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = new MessageDetail();
        $message->user_id = auth()->user()->id;
        $message->vendor_id = $validated['vendor_id'];
        $message->sender_id = auth()->user()->id;
        $message->message = $validated['message'];
        $message->save();

        $topic = str_ireplace("vendor_", "v_", $validated['vendor_id']);
        $title = "New Message";

        $user = User::select('id', 'name')->whereId(auth()->user()->id)->first();
        $user->photo = $user->photo ?? asset('images/user.png');

        $order = Order::where('user_id', auth()->user()->id)->latest()->first();

        $orderData = $order ? [
            'is_chat' => "1",
            'path' => 'orders/' . $order->code . '/customerDriver/chats',
            'user' => $user,
            'peer' => json_encode($user),
            'title' => $title,
            'body' => $validated['message'],
        ] : [];

        // Ensure $orderData is an array
        $this->sendOrderFirebaseNotification($topic, $title, $validated['message'], $orderData);
        // $this->sendOrderFirebaseNotification($topic, $title, $validated['message'], $orderData);


        $chatMessages = MessageDetail::with('user', 'vendor')
            ->where('user_id', auth()->user()->id)
            ->where('vendor_id', $validated['vendor_id'])
            ->get();

        $chatMessages = $request->vendor_id
            ? MessageDetail::with('user', 'vendor')->where('user_id', auth()->user()->id)
            ->where('vendor_id', $request->vendor_id)
            ->get()
            : collect();


        $authImage = auth()->user()->photo;
        $vendor = User::find($validated['vendor_id']);
        $vendorImage = $vendor->photo ?? asset('images/user.png');

        $view = view('ssr.chat_details', compact('chatMessages', 'authImage', 'vendorImage', 'vendor', 'message'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }


    public function vendorMessage(Request $request)
    {
        $vendor = User::whereId($request->vendor_id)->firstOrFail();

        $messages = Message::with('vendor')->where('user_id', auth()->user()->id)->latest()->get();
        $message = MessageDetail::with('vendor')->where('user_id', auth()->user()->id)->latest()->first();
        $chatMessages = MessageDetail::with('user', 'vendor')->where('user_id', auth()->user()->id)
            ->where('vendor_id', $request->vendor_id)
            ->get();
        $authImage = auth()->user()->photo;
        $vendorImage = $vendor->photo ?? asset('images/user.png');
        // dd($messages);
        $view = view('ssr.chat_details', compact('chatMessages', 'authImage', 'vendorImage', 'vendor', 'messages', 'message'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }
}
