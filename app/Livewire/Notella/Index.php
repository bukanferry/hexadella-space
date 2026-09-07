<?php

namespace App\Livewire\Notella;

use App\Models\Notella;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $content = '';
    public $generatedSlug = null;
    public $expiresIn = 10; // default 10 minutes

    protected $rules = [
        'content' => 'required|string|max:10000',
        'expiresIn' => 'required|integer|in:10,60,1440,10080', // 10m, 1h, 1d, 7d
    ];

    public function submit()
    {
        $this->validate();

        $slug = Str::random(12);

        Notella::create([
            'slug' => $slug,
            'content' => $this->content,
            'expires_at' => now()->addMinutes($this->expiresIn),
        ]);

        $this->generatedSlug = $slug;
        $this->content = ''; // Clear content for safety
    }

    public function render()
    {
        return view('livewire.notella.index');
    }
}
