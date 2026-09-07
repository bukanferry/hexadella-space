<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomCode;
    public $messageData;

    public function __construct($roomCode, $messageData)
    {
        $this->roomCode = $roomCode;
        $this->messageData = $messageData;
    }

    public function broadcastOn()
    {
        // Using a standard public channel for now to avoid anonymous auth complexities
        return new Channel('whisper.' . $this->roomCode);
    }
    
    public function broadcastAs()
    {
        return 'message.sent';
    }
}
