<?php

namespace App\Livewire\Pollella;

use App\Models\Poll;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Index extends Component
{
    public $question = '';
    public $options = ['', ''];
    public $expiresIn = 1; // 1, 3, or 7 days
    public $generatedLink = null;
    public $isGenerating = false;

    protected $rules = [
        'question' => 'required|min:5|max:255',
        'options' => 'required|array|min:2|max:10',
        'options.*' => 'required|string|max:100',
        'expiresIn' => 'required|in:1,3,7',
    ];

    public function addOption()
    {
        if (count($this->options) < 10) {
            $this->options[] = '';
        }
    }

    public function removeOption($index)
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    public function createPoll()
    {
        $this->validate();

        // Anti-Spam Layer 1: RateLimiter for create-poll
        if (RateLimiter::tooManyAttempts('create-poll:' . request()->ip(), 5)) {
            $this->addError('general', 'Excessive poll generation. Retransmit in 1 hour.');
            return;
        }
        RateLimiter::hit('create-poll:' . request()->ip(), 3600);

        $this->isGenerating = true;

        $uuid = Str::uuid()->toString();

        $poll = Poll::create([
            'uuid' => $uuid,
            'question' => $this->question,
            'expires_at' => now()->addDays((int) $this->expiresIn),
        ]);

        foreach ($this->options as $optionText) {
            $poll->options()->create([
                'text' => $optionText,
            ]);
        }

        $this->generatedLink = route('pollella.show', ['uuid' => $uuid]);
        $this->isGenerating = false;
    }

    public function render()
    {
        return view('livewire.pollella.index')
            ->layout('components.layouts.app')
            ->title('Pollella - Zero-ID Opinion Polls');
    }
}
