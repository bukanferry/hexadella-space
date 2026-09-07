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
        Schema::create('dropella_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dropella_box_id')->constrained()->cascadeOnDelete();
            $table->text('original_name'); // Will store encrypted text
            $table->string('storage_path');
            $table->string('mime_type'); // Will store encrypted text
            $table->unsignedBigInteger('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropella_files');
    }
};
