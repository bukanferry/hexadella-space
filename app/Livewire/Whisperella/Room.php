<?php

namespace App\Livewire\Whisperella;

use Livewire\Component;
use Illuminate\Support\Facades\Redis;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class Room extends Component
{
    use WithFileUploads;
    public $roomCode;
    public $message = '';
    public $messages = [];
    public $media;
    
    public $userId;
    public $userAlias;
    public $userColor;

    public function mount($room_code)
    {
        $this->roomCode = strtolower($room_code);
        
        if (!Redis::exists("whisperella:room_active:{$this->roomCode}")) {
            session()->flash('error', 'Room not found or has already been incinerated/expired.');
            return redirect()->route('whisperella.index');
        }

        // Generate or retrieve anonymous identity for this room
        if (!session()->has("whisperella_identity:{$this->roomCode}")) {
            $colors = ['text-red-400', 'text-blue-400', 'text-green-400', 'text-yellow-400', 'text-purple-400', 'text-pink-400', 'text-indigo-400', 'text-teal-400', 'text-orange-400'];
            $aliases = ['Foxella', 'Owlella', 'Wolfella', 'Bearella', 'Lynxella', 'Hawkella', 'Sealella', 'Crowella', 'Stagella', 'Mothella', 'Catella', 'Batella'];
            
            session()->put("whisperella_identity:{$this->roomCode}", [
                'id' => uniqid('u_'),
                'alias' => $aliases[array_rand($aliases)] . rand(10, 99),
                'color' => $colors[array_rand($colors)],
            ]);
        }

        $identity = session()->get("whisperella_identity:{$this->roomCode}");
        $this->userId = $identity['id'];
        $this->userAlias = $identity['alias'];
        $this->userColor = $identity['color'];

        $this->loadMessages();
    }

    public function loadMessages()
    {
        // Load messages from Redis
        $stored = Redis::lrange("whisperella:{$this->roomCode}", 0, -1);
        
        if ($stored) {
            $this->messages = array_map(function ($msg) {
                return json_decode($msg, true);
            }, $stored);
        } else {
            $this->messages = [];
        }
    }

    public function sendMessage($payload = '', $hasMedia = false)
    {
        if (empty($payload) && !$this->media && !$hasMedia) {
            return;
        }

        $mediaUrl = null;
        if ($this->media) {
            // Store encrypted media as .dat
            $path = $this->media->store("ephemeral_media/{$this->roomCode}", 'public');
            $mediaUrl = \Illuminate\Support\Facades\Storage::url($path);
        }

        $messageData = [
            'id' => uniqid(),
            'sender_id' => $this->userId,
            'alias' => $this->userAlias,
            'color' => $this->userColor,
            'encrypted_payload' => $payload, // The encrypted JSON string (contains text and media_url from frontend)
            'media_url' => $mediaUrl, // We expose media_url plaintext so the frontend can fetch it. The CONTENT of the media is encrypted.
            'timestamp' => now()->toIso8601String(),
        ];

        // Store to Redis
        Redis::rpush("whisperella:{$this->roomCode}", json_encode($messageData));
        Redis::ltrim("whisperella:{$this->roomCode}", -100, -1); // Keep last 100
        Redis::expire("whisperella:{$this->roomCode}", 15 * 60); // 15 mins TTL
        Redis::expire("whisperella:room_active:{$this->roomCode}", 15 * 60); // 15 mins TTL for active state

        // Clear input
        $this->reset(['media']);

        $this->loadMessages();

        // Broadcast locally for UI to scroll
        $this->dispatch('message-sent');

        // Broadcast to other users via Reverb
        broadcast(new \App\Events\MessageSent($this->roomCode, $messageData))->toOthers();
    }

    public function destroyRoom()
    {
        Redis::del("whisperella:{$this->roomCode}");
        Redis::del("whisperella:room_active:{$this->roomCode}");
        
        \Illuminate\Support\Facades\Storage::disk('public')->deleteDirectory("ephemeral_media/{$this->roomCode}");

        session()->flash('message', 'The covert room has been successfully eradicated without a trace.');
        return redirect()->route('whisperella.index');
    }

    #[On('echo:whisper.{roomCode},.message.sent')]
    public function onMessageSent($event)
    {
        // When another user sends a message, reload the list and scroll down
        $this->loadMessages();
        $this->dispatch('message-sent');
    }

    public function render()
    {
        return view('livewire.whisperella.room')
            ->layout('components.layouts.app', ['title' => 'Room (E2EE) | Whisperella']);
    }
}
