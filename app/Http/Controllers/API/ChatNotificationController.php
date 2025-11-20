<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\MessageDetail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\FirebaseMessagingTrait;

class ChatNotificationController extends Controller
{
    use FirebaseMessagingTrait;
    //
    public function send(Request $request)
    {
        Log::info("Chat Notification Payload => " . json_encode($request->all()));
        $peer = $request->peer;
        if (!\Str::contains($request->peer['id'], 'vendor_')) {
            $peerUser = User::with('roles')->where('id', $request->peer['id'])->first();
            $peer["role"] = $peerUser->roles->first;
        } else {
            // $peer['id'] = str_ireplace("vendor_","v_",$peer['id']);
            $peer["role"] = "manager";
        }
        $peer = json_encode($peer);
        $topic = str_ireplace("vendor_", "v_", $request->topic);

        try {
            $orderData = [
                'is_chat' => "1",
                'path' => $request->path,
                'user' => $peer,
                'peer' => json_encode($request->user),
                'title' => $request->title,
                'body' => $request->body,
            ];

            $authUser = User::whereId(Auth::id())->first();
            if($authUser->is_driver != null ){
                $vendor_id = $authUser->id;
                $user_id = $request->topic;
            }else{
                $vendor_id = $request->topic;
                $user_id = $authUser->id;
            }

            $messageHeaderData = [
                'vendor_id' => $vendor_id,
                'user_id' => $user_id,
                'message' => $request->body,
                'sender_id' => Auth::id(),
            ];

            Message::updateOrCreate(
                ['vendor_id' => $vendor_id, 'user_id' => $user_id],
                $messageHeaderData
            );
            MessageDetail::create($messageHeaderData);


            // logger("Chat Notification Data", $orderData);
            $this->sendOrderFirebaseNotification($topic, $request->title, $request->body, $orderData);

            

            //
            // logger("Chat Data", $orderData);
            return response()->json([
                "message" => __("Notification sent successfully")
            ], 200);
        } catch (\Exception $ex) {
            logger("Chat Error", [$ex]);
            return response()->json([
                "message" => $ex->getMessage() ?? __("Notification failed")
            ], 400);
        }
    }

    public function chatList(Request $request)
    {
        $messages = Message::with('user','vendor')->where('user_id', Auth::id())->latest()->get();
        return response()->json([
            "messages" => $messages
        ], 200);
    }

    public function chatDetails(Request $request)
    {
        $chatMessages = MessageDetail::with('user','vendor')->where('user_id', Auth::id())
                    ->where('vendor_id', $request->vendor_id)
                    ->latest()
                    ->get();
        return response()->json([
            "chatMessages" => $chatMessages
        ], 200);
    }
}
