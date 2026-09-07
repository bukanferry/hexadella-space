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
        Schema::create('havenella_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('havenella_post_id')->constrained()->cascadeOnDelete();
            $table->string('fingerprint_hash'); // Voter's fingerprint (Zero Logs)
            $table->enum('type', ['up', 'down']);
            $table->timestamps();
            
            // Ensure 1 fingerprint can only vote once per post
            $table->unique(['havenella_post_id', 'fingerprint_hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('havenella_votes');
    }
};
