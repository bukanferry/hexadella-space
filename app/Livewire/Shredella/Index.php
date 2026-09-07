<?php

namespace App\Livewire\Shredella;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $photo;
    public $errorMsg = '';
    public $downloadPath = null;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:15360', // 15MB max
        ]);
        $this->errorMsg = '';
        $this->downloadPath = null;
    }

    public function scrub()
    {
        $this->validate([
            'photo' => 'required|image|max:15360',
        ]);

        try {
            // File is already scrubbed by the client (Canvas API).
            // We just need to move it to a private directory for download.
            $filename = 'sterilized_' . Str::random(16) . '.jpg';
            $dir = storage_path('app/private/shredella');
            
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $path = $dir . '/' . $filename;
            
            // Move the temporary uploaded file
            file_put_contents($path, file_get_contents($this->photo->getRealPath()));
            
            $this->downloadPath = $path;
            
        } catch (\Exception $e) {
            $this->errorMsg = 'Failed to process sterilized image: ' . $e->getMessage();
        }
    }

    public function downloadAndDestroy()
    {
        if ($this->downloadPath && file_exists($this->downloadPath)) {
            $path = $this->downloadPath;
            
            // Reset state to allow the user to upload again
            $this->downloadPath = null;
            $this->photo = null;
            
            // Deliver file to user, and immediately purge from server upon transmission
            return response()->download($path, 'hexadella_clean_image.jpg')->deleteFileAfterSend(true);
        }
    }

    public function render()
    {
        return view('livewire.shredella.index')->layout('components.layouts.app');
    }
}
