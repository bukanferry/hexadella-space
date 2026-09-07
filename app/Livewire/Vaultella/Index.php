<?php

namespace App\Livewire\Vaultella;

use App\Models\Vaultella;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $file;
    public $encryptedFilename = ''; // Ciphertext of the original filename
    public $generatedLink = null;
    public $uuid = null;
    public $isUploading = false;

    protected $rules = [
        'file' => 'required|max:20480', // Max 20MB. Removed mimes because E2EE blob has no mime type
        'encryptedFilename' => 'required|string|max:1000'
    ];

    public function updatedFile()
    {
        $this->validateOnly('file');
    }

    public function uploadFile()
    {
        $this->validate();

        $this->isUploading = true;

        $uuid = Str::uuid()->toString();
        
        // Store the encrypted blob as a generic .dat file
        $path = $this->file->storeAs('vaultella', $uuid . '.dat');

        $vault = Vaultella::create([
            'uuid' => $uuid,
            'file_path' => $path,
            'original_name' => $this->encryptedFilename, // Storing ENCRYPTED filename, not the real one
            'mime_type' => 'application/octet-stream', // Masked mime type
            'size' => $this->file->getSize(),
            'expires_at' => now()->addHours(24),
        ]);

        $this->uuid = $uuid;
        // The URL hash will be appended on the client side
        $this->generatedLink = route('vaultella.download', ['uuid' => $uuid]);
        $this->isUploading = false;
        $this->file = null;
        $this->encryptedFilename = '';
    }

    public function render()
    {
        return view('livewire.vaultella.index')
            ->layout('components.layouts.app')
            ->title('Vaultella - Burn-After-Download Vault');
    }
}
