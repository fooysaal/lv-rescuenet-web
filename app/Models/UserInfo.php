<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'dob',
        'address',
        'city',
        'state',
        'nid_info',
        'family_info',
        'nid_front_image',
        'nid_back_image',
        'selfie_with_nid_image',
        'nid_verification_status',
        'nid_verified_at',
        'latitude',
        'longitude',
        'location_name',
        'location_updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dob' => 'date',
        'nid_info' => 'array',
        'family_info' => 'array',
        'nid_verified_at' => 'datetime',
        'location_updated_at' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the user that owns the user info.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if NID verification is completed.
     */
    public function hasVerifiedNID(): bool
    {
        return $this->nid_verification_status === 'verified';
    }

    /**
     * Check if user has uploaded NID images.
     */
    public function hasNIDImages(): bool
    {
        return !empty($this->nid_front_image) && !empty($this->nid_back_image);
    }
}
