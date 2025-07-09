<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // Tambahkan ini

class MessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;

    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    // Saluran broadcasting
    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->user->id);
    }

    // Data yang akan dikirimkan dengan event broadcast
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user' => $this->user->name
        ];
    }
}
