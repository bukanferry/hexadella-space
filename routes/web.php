<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Whisperella\Index as WhisperellaIndex;
use App\Livewire\Whisperella\Room as WhisperellaRoom;
use App\Livewire\Vaultella\Index as VaultellaIndex;
use App\Livewire\Vaultella\Download as VaultellaDownload;
use App\Livewire\Pollella\Index as PollellaIndex;
use App\Livewire\Pollella\Show as PollellaShow;
use App\Livewire\Havenella\Index as HavenellaIndex;
use App\Livewire\Maskella\Index as MaskellaIndex;
use App\Livewire\Maskella\Show as MaskellaShow;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/manual', function () {
    return view('manual');
})->name('manual');

// Whisperella Routes
Route::get('/whisperella', WhisperellaIndex::class)->name('whisperella.index');
Route::get('/whisperella/{room_code}', WhisperellaRoom::class)->name('whisperella.room');

// Vaultella Routes
Route::get('/vaultella', VaultellaIndex::class)->name('vaultella.index');
Route::get('/vault/{uuid}', VaultellaDownload::class)->name('vaultella.download');
Route::get('/api/vault/blob/{uuid}', function ($uuid) {
    $vault = \App\Models\Vaultella::where('uuid', $uuid)->first();
    if (!$vault || $vault->expires_at < now()) {
        if ($vault) $vault->delete();
        abort(404);
    }
    
    $filePath = $vault->file_path;
    if (!\Illuminate\Support\Facades\Storage::exists($filePath)) {
        $vault->delete();
        abort(404);
    }
    
    $absolutePath = \Illuminate\Support\Facades\Storage::path($filePath);
    $vault->delete(); // Burn after reading
    
    return response()->download($absolutePath, 'vault.dat')->deleteFileAfterSend(true);
})->name('vaultella.blob');

// Maskella Routes
Route::get('/maskella', \App\Livewire\Maskella\Index::class)->name('maskella.index');
Route::get('/m/{slug}', \App\Livewire\Maskella\Show::class)->name('maskella.show');

// Notella (Burn-After-Reading Note)
Route::get('/notella', \App\Livewire\Notella\Index::class)->name('notella.index');
Route::get('/n/{slug}', \App\Livewire\Notella\Show::class)->name('notella.show');

// Dropella (Blind Drop Zone)
Route::get('/dropella', \App\Livewire\Dropella\Index::class)->name('dropella.index');
Route::get('/d/{slug}', \App\Livewire\Dropella\Drop::class)->name('dropella.drop');
Route::get('/d/{slug}/unlock', \App\Livewire\Dropella\Unlock::class)->name('dropella.unlock');

// Splitella & Shredella
Route::get('/splitella', \App\Livewire\Splitella\Index::class);
Route::get('/shredella', \App\Livewire\Shredella\Index::class);

// Pollella Routes
Route::get('/pollella', PollellaIndex::class)->name('pollella.index');
Route::get('/poll/{uuid}', PollellaShow::class)->name('pollella.show');

// Havenella Routes
Route::get('/havenella', HavenellaIndex::class)->name('havenella.index');
