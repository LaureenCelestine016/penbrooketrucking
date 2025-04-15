<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\ChatMessage;
use App\Models\User;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $receiverId;
    public $message;

    public function __construct(User $sender, $receiverId, ChatMessage $message)
    {
        $this->sender = $sender;
        $this->receiverId = $receiverId;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    public function broadcastWith()
    {
        return [
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
            ],
            'message' => [
                'id' => $this->message->id,
                'body' => $this->message->body,
                'sender_id' => $this->message->sender_id,
                'receiver_id' => $this->message->receiver_id,
                'created_at' => $this->message->created_at->toDateTimeString(),
            ],
        ];
    }
}
