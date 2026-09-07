<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use App\Models\Vaultella;
use App\Models\Poll;
use App\Models\HavenellaPost;
use App\Models\MaskInbox;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Garbage Collector for Ephemeral Media
Schedule::call(function () {
    $disk = Storage::disk('public');
    $directories = $disk->directories('ephemeral_media');

    foreach ($directories as $dir) {
        $roomCode = basename($dir);
        
        // If the room is no longer active in Redis (expired or destroyed), burn the media!
        if (!Redis::exists("whisperella:room_active:{$roomCode}")) {
            $disk->deleteDirectory($dir);
            \Illuminate\Support\Facades\Log::info("Burned ephemeral media for expired room: {$roomCode}");
        }
    }

    // Clean up Expired Vaultella
    Vaultella::where('expires_at', '<', now())
        ->chunkById(50, function ($vaults) {
            foreach ($vaults as $vault) {
                if (Storage::exists($vault->file_path)) {
                    Storage::delete($vault->file_path);
                }
                $vault->delete();
            }
        });

    // Clean up Expired Pollella
    Poll::where('expires_at', '<', now())
        ->chunkById(50, function ($polls) {
            foreach ($polls as $poll) {
                $poll->delete();
            }
        });

    // Daily Cleanup for Mask Inboxes
    Schedule::call(function () {
        \App\Models\MaskInbox::where('expires_at', '<', now())
            ->chunkById(100, function ($inboxes) {
                foreach ($inboxes as $inbox) {
                    $inbox->delete();
                }
            });
    })->daily();

    // Minute Cleanup for Notella (Burn-After-Reading)
    Schedule::call(function () {
        \App\Models\Notella::where('expires_at', '<', now())
            ->chunkById(100, function ($notellas) {
                foreach ($notellas as $notella) {
                    $notella->delete();
                }
            });
    })->everyMinute();

    // Hourly Cleanup for Dropella Boxes
    Schedule::call(function () {
        \App\Models\DropellaBox::where('expires_at', '<', now())
            ->chunkById(100, function ($boxes) {
                foreach ($boxes as $box) {
                    \Illuminate\Support\Facades\Storage::deleteDirectory('dropella/' . $box->id);
                    $box->delete();
                }
            });
    })->hourly();

    // Clean up Expired Havenella
    HavenellaPost::where('expires_at', '<', now())
        ->chunkById(50, function ($posts) {
            foreach ($posts as $post) {
                $post->delete();
            }
        });
})->everyMinute();

Schedule::call(function () {
    MaskInbox::where('expires_at', '<', now())->chunkById(100, function ($rows) {
        $rows->each->delete(); // This will cascade delete messages because of foreignId cascadeOnDelete
    });
})->daily();
