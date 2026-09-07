<?php

namespace App\Livewire\Dropella;

use App\Models\DropellaBox;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $title = '';
    public $expiresIn = 3; // default 3 days
    public $createdBox = null;
    public $secretKey = null;

    protected $rules = [
        'title' => 'nullable|string|max:100',
        'expiresIn' => 'required|integer|in:1,3,7',
    ];

    public function createBox()
    {
        $this->validate();

        $publicSlug = Str::random(8);
        while (DropellaBox::where('public_slug', $publicSlug)->exists()) {
            $publicSlug = Str::random(8);
        }

        $secretToken = Str::random(32);
        $hashedToken = Hash::make($secretToken);

        $box = DropellaBox::create([
            'public_slug' => $publicSlug,
            'title' => $this->title ?: 'Blind Drop Zone',
            'secret_key_hash' => $hashedToken,
            'expires_at' => now()->addDays($this->expiresIn),
        ]);

        $this->createdBox = $box;
        $this->secretKey = $secretToken;
    }

    public function render()
    {
        return view('livewire.dropella.index');
    }
}
