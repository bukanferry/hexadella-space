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
        Schema::create('havenella_posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('content'); // Max 500 chars enforced at validation level
            $table->string('fingerprint_hash'); // Creator's fingerprint (Zero Logs)
            $table->integer('score')->default(0); // Upvotes - Downvotes
            $table->timestamp('expires_at');
            $table->timestamps();
            
            $table->index('expires_at'); // Helpful for the cron job cleanup
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('havenella_posts');
    }
};
