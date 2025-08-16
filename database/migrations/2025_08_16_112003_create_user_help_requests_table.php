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
        Schema::create('user_help_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->enum('type', ['police', 'fire', 'ambulance', 'volunteer']);
            $table->text('description');

            $table->double('latitude', 10, 6);
            $table->double('longitude', 10, 6);

            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id')->nullable();

            $table->enum('status', ['pending', 'in_progress', 'resolved', 'cancelled'])->default('pending');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('state_divisions')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_help_requests');
    }
};
