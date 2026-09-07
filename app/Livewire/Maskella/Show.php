<?php

namespace App\Livewire\Maskella;

use Livewire\Component;
use App\Models\MaskInbox;
use App\Models\MaskMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public MaskInbox $inbox;
    
    #[Url]
    public $key = '';

    public $isOwner = false;
    public $messageContent = '';
    public $successMessage = false;

    protected $rules = [
        'messageContent' => 'required|string|max:2000',
    ];

    public function mount($slug)
    {
        $this->inbox = MaskInbox::where('public_slug', $slug)->firstOrFail();

        if ($this->key) {
            if (Hash::check($this->key, $this->inbox->secret_token_hash)) {
                $this->isOwner = true;
                // Update expiry on activity
                $this->inbox->update(['expires_at' => now()->addDays(30)]);
            } else {
                // If key is present but wrong, we just clear it to show public view securely
                $this->key = '';
            }
        }
    }

    public function sendMessage()
    {
        if ($this->isOwner) {
            return; // Owner cannot send message to themselves in dashboard mode
        }

        $this->validate();

        // Rate Limiter: Max 5 messages per hour per IP per inbox
        $rateLimitKey = 'maskella_send:' . $this->inbox->id . ':' . request()->ip();
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            $this->addError('messageContent', "Excessive transmissions detected. Retransmit in {$seconds} seconds.");
            return;
        }

        // Basic Keyword Filter
        $forbiddenKeywords = ['kontol', 'memek', 'ngentot', 'bunuh', 'rek', 'rekening'];
        foreach ($forbiddenKeywords as $word) {
            if (stripos($this->messageContent, $word) !== false) {
                $this->addError('messageContent', 'Transmission rejected: Content violates platform strictures.');
                return;
            }
        }

        RateLimiter::hit($rateLimitKey, 3600);

        // Generate fingerprint hash to prevent spam (optional tracking for moderation)
        $userAgent = request()->userAgent();
        $ip = request()->ip();
        $fingerprint = hash('sha256', $ip . $userAgent . config('app.key'));

        $this->inbox->messages()->create([
            'content' => $this->messageContent,
            'fingerprint_hash' => $fingerprint
        ]);

        $this->messageContent = '';
        $this->successMessage = true;
    }

    public function deleteMessage($id)
    {
        if (!$this->isOwner) return;

        $msg = $this->inbox->messages()->find($id);
        if ($msg) {
            $msg->delete();
        }
    }

    public function getMessagesProperty()
    {
        if (!$this->isOwner) {
            return collect([]);
        }
        
        return $this->inbox->messages()->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.maskella.show');
    }
}
