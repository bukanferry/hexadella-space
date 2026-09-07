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
        Schema::create('mask_inboxes', function (Blueprint $table) {
            $table->id();
            $table->string('public_slug')->unique(); // Public URL slug (e.g. /m/ask-me-anything)
            $table->string('title')->nullable();
            $table->string('secret_token_hash'); // Bcrypt hash of the private key
            $table->timestamp('expires_at'); // Expiration date (30 days from creation or last activity)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mask_inboxes');
    }
};
