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
        Schema::table('user_infos', function (Blueprint $table) {
            // NID (National ID) verification fields - Step 2
            $table->string('nid_front_image')->nullable()->after('user_id');
            $table->string('nid_back_image')->nullable()->after('nid_front_image');
            $table->string('selfie_with_nid_image')->nullable()->after('nid_back_image');
            $table->enum('nid_verification_status', ['pending', 'verified', 'rejected'])->default('pending')->after('selfie_with_nid_image');
            $table->timestamp('nid_verified_at')->nullable()->after('nid_verification_status');

            // Location data - Step 3
            $table->decimal('latitude', 10, 8)->nullable()->after('user_id');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('location_name')->nullable()->after('longitude'); // Human-readable location
            $table->timestamp('location_updated_at')->nullable()->after('location_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn([
                'nid_front_image',
                'nid_back_image',
                'selfie_with_nid_image',
                'nid_verification_status',
                'nid_verified_at',
                'latitude',
                'longitude',
                'location_name',
                'location_updated_at'
            ]);
        });
    }
};
