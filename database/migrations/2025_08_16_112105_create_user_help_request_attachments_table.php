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
        Schema::create('user_help_request_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->string('file_path'); // Store full path or filename
            $table->string('file_type')->nullable(); // image, video, etc.
            $table->timestamps();

            $table->foreign('help_request_id')->references('id')->on('user_help_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_help_request_attachments');
    }
};
