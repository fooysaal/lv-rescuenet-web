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
        Schema::table('users', function (Blueprint $table) {
            // Registration workflow status
            $table->enum('registration_status', ['pending', 'step1_completed', 'step2_completed', 'completed'])->default('pending')->after('gender');
            $table->timestamp('registration_completed_at')->nullable()->after('registration_status');

            // Temporary registration token (expires in 30 mins)
            $table->string('registration_token')->nullable()->after('registration_completed_at');
            $table->timestamp('registration_token_expires_at')->nullable()->after('registration_token');

            // Track which step user is on
            $table->tinyInteger('current_registration_step')->default(1)->after('registration_token_expires_at');

            // Phone verification status
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'registration_status',
                'registration_completed_at',
                'registration_token',
                'registration_token_expires_at',
                'current_registration_step',
                'phone_verified_at'
            ]);
        });
    }
};
