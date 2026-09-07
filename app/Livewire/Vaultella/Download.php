<?php

namespace App\Livewire\Vaultella;

use App\Models\Vaultella;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Download extends Component
{
    public $uuid;
    public $encryptedFilename = '';
    public $notFound = false;
    public $isDestroyed = false;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->loadVault();
    }

    public function loadVault()
    {
        $vault = Vaultella::where('uuid', $this->uuid)->first();
        if (!$vault) {
            $this->notFound = true;
        } elseif ($vault->expires_at < now()) {
            // Self destruct if expired
            if (Storage::exists($vault->file_path)) {
                Storage::delete($vault->file_path);
            }
            $vault->delete();
            $this->notFound = true;
        } else {
            // Pass the encrypted filename to the view
            $this->encryptedFilename = $vault->original_name;
        }
    }
    
    public function render()
    {
        return view('livewire.vaultella.download')
            ->layout('components.layouts.app')
            ->title('Vaultella - Burn-After-Download');
    }
}
