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
        Schema::create('user_request_flag_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_help_request_id');
            $table->unsignedBigInteger('reported_by_user_id');
            $table->string('report_type');
            $table->text('report_reason');
            $table->string('attachment')->nullable();
            $table->timestamps();

            $table->foreign('user_help_request_id')->references('id')->on('user_help_requests')->onDelete('cascade');
            $table->foreign('reported_by_user_id')->references('id')->on('users')->onDelete('cascade');

            // Ensure one user can only submit one flag report per help request
            $table->unique(['user_help_request_id', 'reported_by_user_id'], 'flag_report_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_request_flag_reports');
    }
};
