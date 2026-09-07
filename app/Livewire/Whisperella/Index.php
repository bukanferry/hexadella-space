<?php

namespace App\Livewire\Whisperella;

use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $roomCode = '';

    public function createRoom($code)
    {
        $code = strtolower($code);
        // Register room as active
        \Illuminate\Support\Facades\Redis::setex("whisperella:room_active:{$code}", 15 * 60, "1");
        
        // Return success so frontend can redirect
        return true;
    }

    public function joinRoom()
    {
        $this->validate([
            'roomCode' => 'required|min:6|max:10'
        ]);

        return redirect()->route('whisperella.room', ['room_code' => strtolower($this->roomCode)]);
    }

    public function render()
    {
        return view('livewire.whisperella.index')
            ->layout('components.layouts.app', ['title' => 'Whisperella | Hexadella Space']);
    }
}
