<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mask_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mask_inbox_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->string('fingerprint_hash')->nullable(); // Optional, to prevent spamming
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mask_messages');
    }
};
