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
        Schema::create('user_help_request_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('help_request_id');
            $table->unsignedBigInteger('performed_by')->nullable(); // admin/volunteer
            $table->text('note')->nullable();
            $table->enum('action', ['requested', 'assigned', 'in_progress', 'resolved', 'cancelled']);
            $table->timestamps();

            $table->foreign('help_request_id')->references('id')->on('user_help_requests')->onDelete('cascade');
            $table->foreign('performed_by')->references('id')->on('users')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_help_request_logs');
    }
};
