<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    public function index($receiverId)
    {
        $user = Auth::user(); // The admin

        $messages = ChatMessage::where(function ($query) use ($receiverId, $user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($receiverId, $user) {
                $query->where('sender_id', $receiverId)
                      ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return Inertia::render('Chat', [
            'receiverId' => (int) $receiverId,
            'messages'   => $messages,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        ChatMessage::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return back(); // 👈 This ensures an Inertia response
    }

    public function fetchMessages($receiverId)
    {

        $message = ChatMessage::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $receiverId);
        })
        ->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', Auth::id());
        })
        ->orderBy('created_at', 'asc')
        ->get();
        dd($message);

        return Inertia::render('Chat', [
            'receiverId' => $receiverId,
            'messages' => ChatMessage::where(function ($query) use ($receiverId) {
                    $query->where('sender_id', Auth::id())->where('receiver_id', $receiverId);
                })
                ->orWhere(function ($query) use ($receiverId) {
                    $query->where('sender_id', $receiverId)->where('receiver_id', Auth::id());
                })
                ->orderBy('created_at', 'asc')
                ->get(),
        ]);
    }

}
