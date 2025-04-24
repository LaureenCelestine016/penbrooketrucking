<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ChatController extends Controller
{
    public function index($receiverId)
    {
        return view('chat.index', compact('receiverId'));
    }

    public function fetchMessages($receiverId)
    {
        // Mark messages from receiver as read
        ChatMessage::where('sender_id', $receiverId)
            ->where('receiver_id', auth()->id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

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
            'is_read' => 0,
        ]);

        broadcast(new MessageSent($sender, $receiverId, $message))->toOthers();

        return response()->json($message);
    }

    public function unreadCounts()
{
    $user = auth()->user();

    $adminId = User::where('user_type', 1)->value('id');

    if ($user->user_type === 1) {
        // Admin: return unread per driver
        $counts = ChatMessage::where('receiver_id', $user->id)
                         ->where('is_read', false)
                         ->groupBy('sender_id')
                         ->selectRaw('sender_id, COUNT(*) as count')
                         ->pluck('count', 'sender_id')
                         ->toArray();

        return response()->json(['counts' => $counts ]);
    } else {
        // Driver: return count from admin
        $count = ChatMessage::where('receiver_id', $user->id)
                        ->where('sender_id', $adminId) // Set admin ID globally or config
                        ->where('is_read', false)
                        ->count();

        return response()->json(['from_admin' => $count]);
    }
}

    public function markAsRead(Request $request)
    {
        ChatMessage::where('sender_id', $request->sender_id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json(['status' => 'ok']);
    }
}
