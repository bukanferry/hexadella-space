<?php

namespace App\Livewire\Dropella;

use App\Models\DropellaBox;
use App\Models\DropellaFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Unlock extends Component
{
    public $slug;
    public $box;
    public $secretKey = '';
    public $isUnlocked = false;
    public $files = [];
    public $error = '';

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->box = DropellaBox::where('public_slug', $slug)->first();

        if (!$this->box) {
            abort(404, 'Drop zone not found or expired.');
        }

        if (session('dropella_unlocked_' . $this->box->id)) {
            $this->isUnlocked = true;
            $this->loadFiles();
        }
    }

    public function unlock()
    {
        if (Hash::check($this->secretKey, $this->box->secret_key_hash)) {
            $this->isUnlocked = true;
            session(['dropella_unlocked_' . $this->box->id => true]);
            $this->loadFiles();
        } else {
            $this->error = 'Invalid key.';
        }
    }

    public function loadFiles()
    {
        $this->files = $this->box->files()->get()->map(function ($file) {
            return [
                'id' => $file->id,
                'name' => Crypt::decryptString($file->original_name),
                'size' => $this->formatBytes($file->size),
                'created_at' => $file->created_at->diffForHumans(),
            ];
        })->toArray();
    }

    public function download($fileId)
    {
        if (!$this->isUnlocked) return;

        $file = DropellaFile::where('id', $fileId)->where('dropella_box_id', $this->box->id)->first();
        if ($file && Storage::exists($file->storage_path)) {
            $name = Crypt::decryptString($file->original_name);
            $mime = Crypt::decryptString($file->mime_type);
            return Storage::download($file->storage_path, $name, ['Content-Type' => $mime]);
        }
    }

    public function deleteFile($fileId)
    {
        if (!$this->isUnlocked) return;

        $file = DropellaFile::where('id', $fileId)->where('dropella_box_id', $this->box->id)->first();
        if ($file) {
            Storage::delete($file->storage_path);
            $file->delete();
            $this->loadFiles();
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function render()
    {
        return view('livewire.dropella.unlock');
    }
}
