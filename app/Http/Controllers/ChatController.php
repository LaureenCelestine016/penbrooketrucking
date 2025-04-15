<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index($receiverId)
    {
        return view('chat.index', compact('receiverId'));
    }

    public function fetchMessages($receiverId)
    {

        $messages = ChatMessage::where(function ($query) use ($receiverId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {

        $sender = Auth::user();
        $receiverId = $request->receiver_id;

        $message = ChatMessage::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($sender, $receiverId, $message))->toOthers();

        return response()->json($message);
    }
}
