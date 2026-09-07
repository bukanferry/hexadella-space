<?php

namespace App\Livewire\Havenella;

use App\Models\HavenellaPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Index extends Component
{
    public $content = '';
    public $fingerprint = null;

    protected $rules = [
        'content' => 'required|min:5|max:500',
    ];

    protected function getClientFingerprintHash()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();
        // Zero Logs hash
        return hash('sha256', $ip . $userAgent . config('app.key'));
    }

    public function createPost()
    {
        $this->validate();

        // Anti-Spam Layer: RateLimiter
        if (RateLimiter::tooManyAttempts('create-havenella-post:' . request()->ip(), 3)) {
            $this->addError('general', 'Rate limit exceeded: Maximum 3 transmissions per hour. Stand down.');
            return;
        }
        RateLimiter::hit('create-havenella-post:' . request()->ip(), 3600);

        $this->fingerprint = $this->getClientFingerprintHash();

        HavenellaPost::create([
            'uuid' => Str::uuid()->toString(),
            'content' => $this->content,
            'fingerprint_hash' => $this->fingerprint,
            'score' => 0,
            'expires_at' => now()->addDays(7),
        ]);

        $this->content = '';
        $this->dispatch('post-created');
    }

    public function vote($postId, $type)
    {
        if (!in_array($type, ['up', 'down'])) return;

        // Anti-Spam Layer: RateLimiter for voting
        if (RateLimiter::tooManyAttempts('vote-havenella-post:' . request()->ip(), 60)) {
            $this->addError('general', 'Interaction threshold exceeded (Rate Limit).');
            return;
        }
        RateLimiter::hit('vote-havenella-post:' . request()->ip(), 60);

        $this->fingerprint = $this->getClientFingerprintHash();
        
        $post = HavenellaPost::find($postId);
        if (!$post) return;

        // Check if user has already voted on this specific post
        $existingVote = $post->votes()->where('fingerprint_hash', $this->fingerprint)->first();

        if ($existingVote) {
            // Cannot vote twice
            return;
        }

        \DB::transaction(function () use ($post, $type) {
            $post->votes()->create([
                'fingerprint_hash' => $this->fingerprint,
                'type' => $type,
            ]);

            if ($type === 'up') {
                $post->increment('score');
            } else {
                $post->decrement('score');
            }
        });
    }

    public function render()
    {
        // Hide posts with score <= -5 (Community Moderation)
        $posts = HavenellaPost::with('votes')
                    ->where('score', '>', -5)
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        $this->fingerprint = $this->getClientFingerprintHash();

        return view('livewire.havenella.index', [
            'posts' => $posts
        ])
        ->layout('components.layouts.app')
        ->title('Havenella - Ephemeral Public Board');
    }
}
