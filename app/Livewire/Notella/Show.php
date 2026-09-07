<?php

namespace App\Livewire\Notella;

use App\Models\Notella;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public $message = null;
    public $notFound = false;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
        $notella = Notella::where('slug', $slug)->first();

        if (!$notella) {
            $this->notFound = true;
            return;
        }

        $this->message = $notella->content;

        // AUTO BURN INSTANTLY
        $notella->delete();
    }

    public function render()
    {
        return view('livewire.notella.show');
    }
}
