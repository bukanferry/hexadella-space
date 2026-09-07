<?php

namespace App\Livewire\Pollella;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Show extends Component
{
    public $poll;
    public $hasVoted = false;
    public $selectedOption = null;
    public $fingerprint = null;
    
    // To handle LocalStorage updates on the client side
    public $notifyClientVoted = false;

    public function mount($uuid)
    {
        $this->poll = Poll::where('uuid', $uuid)->with('options')->firstOrFail();
        
        // If expired, consider it as "hasVoted" so they can just see the results
        if ($this->poll->expires_at->isPast()) {
            $this->hasVoted = true;
        } else {
            $this->checkServerFingerprint();
        }
    }

    protected function getClientFingerprintHash()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();
        // Layer 2: Secure Server-side Hash (Zero Logs)
        return hash('sha256', $ip . $userAgent . $this->poll->id . config('app.key'));
    }

    public function checkServerFingerprint()
    {
        $this->fingerprint = $this->getClientFingerprintHash();
        
        $voterExists = $this->poll->voters()->where('fingerprint_hash', $this->fingerprint)->exists();
        if ($voterExists) {
            $this->hasVoted = true;
        }
    }

    public function markAsVotedFromClient()
    {
        // This is called by AlpineJS if LocalStorage says they voted.
        $this->hasVoted = true;
    }

    public function vote()
    {
        if ($this->hasVoted || $this->poll->expires_at->isPast()) {
            return;
        }

        $this->validate([
            'selectedOption' => 'required|exists:poll_options,id',
        ]);

        // Anti-Spam Layer 3: RateLimiter for vote-poll
        if (RateLimiter::tooManyAttempts('vote-poll:' . request()->ip(), 30)) {
            $this->addError('general', 'Excessive interactions. Retransmit later.');
            return;
        }
        RateLimiter::hit('vote-poll:' . request()->ip(), 60);

        // Double check fingerprint
        $this->fingerprint = $this->getClientFingerprintHash();
        if ($this->poll->voters()->where('fingerprint_hash', $this->fingerprint)->exists()) {
            $this->hasVoted = true;
            $this->addError('general', 'You have already cast a vote on this poll.');
            return;
        }

        // Use transaction to ensure atomicity
        \DB::transaction(function () {
            // Increment the specific option
            PollOption::where('id', $this->selectedOption)->increment('votes');
            // Increment the total poll votes
            $this->poll->increment('total_votes');
            // Record voter fingerprint
            $this->poll->voters()->create([
                'fingerprint_hash' => $this->fingerprint,
            ]);
        });

        // Refresh poll data to get new counts
        $this->poll->refresh();
        $this->hasVoted = true;
        
        // Signal AlpineJS to set LocalStorage (Anti-Sybil Layer 1)
        $this->notifyClientVoted = true;
    }

    public function render()
    {
        return view('livewire.pollella.show')
            ->layout('components.layouts.app')
            ->title('Pollella - ' . \Str::limit($this->poll->question, 50));
    }
}
