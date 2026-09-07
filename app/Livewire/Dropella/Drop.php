<?php

namespace App\Livewire\Dropella;

use App\Models\DropellaBox;
use App\Models\DropellaFile;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class Drop extends Component
{
    use WithFileUploads;

    public $slug;
    public $box;
    public $file;
    public $uploadSuccess = false;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->box = DropellaBox::where('public_slug', $slug)->first();

        if (!$this->box) {
            abort(404, 'Drop zone not found or expired.');
        }
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|max:10240', // 10MB limit
        ]);
    }

    public function saveFile()
    {
        $this->validate([
            'file' => 'required|max:10240',
        ]);

        $path = $this->file->store('dropella/' . $this->box->id);

        DropellaFile::create([
            'dropella_box_id' => $this->box->id,
            'original_name' => Crypt::encryptString($this->file->getClientOriginalName()),
            'storage_path' => $path,
            'mime_type' => Crypt::encryptString($this->file->getMimeType()),
            'size' => $this->file->getSize(),
        ]);

        $this->uploadSuccess = true;
        $this->file = null;
    }

    public function render()
    {
        return view('livewire.dropella.drop');
    }
}
