<?php

namespace App\Livewire\Splitella;

use Livewire\Component;

class Index extends Component
{
    public $mode = 'split'; // 'split' or 'reconstruct'

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function render()
    {
        return view('livewire.splitella.index')->layout('components.layouts.app');
    }
}
