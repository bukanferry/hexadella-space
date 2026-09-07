<?php

namespace App\Livewire\Maskella;

use Livewire\Component;
use App\Models\MaskInbox;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $title = '';
    
    public $createdInbox = null;
    public $privateLink = null;
    public $publicLink = null;

    protected $rules = [
        'title' => 'nullable|string|max:100',
    ];

    public function createInbox()
    {
        $this->validate();

        // 1. Generate URLs and Tokens
        $publicSlug = Str::random(8); // Public slug
        // Ensure uniqueness
        while (MaskInbox::where('public_slug', $publicSlug)->exists()) {
            $publicSlug = Str::random(8);
        }
        
        $secretToken = Str::random(32); // Private key

        // 2. Hash token for database
        $hashedToken = Hash::make($secretToken);

        // 3. Create Inbox
        $inbox = MaskInbox::create([
            'public_slug' => $publicSlug,
            'title' => $this->title ?: 'Anonymous Inbox',
            'secret_token_hash' => $hashedToken,
            'expires_at' => now()->addDays(30),
        ]);

        $this->createdInbox = $inbox;
        $this->publicLink = route('maskella.show', ['slug' => $publicSlug]);
        $this->privateLink = route('maskella.show', ['slug' => $publicSlug, 'key' => $secretToken]);
    }

    public function render()
    {
        return view('livewire.maskella.index');
    }
}
