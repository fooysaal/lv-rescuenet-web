<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'gender',
        'profile_picture',
        'password',
        'role',
        'registration_status',
        'registration_completed_at',
        'registration_token',
        'registration_token_expires_at',
        'current_registration_step',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'registration_completed_at' => 'datetime',
            'registration_token_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's information.
     */
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * Check if registration token is valid.
     */
    public function hasValidRegistrationToken(): bool
    {
        return $this->registration_token
            && $this->registration_token_expires_at
            && $this->registration_token_expires_at->isFuture();
    }

    /**
     * Check if user has completed registration.
     */
    public function hasCompletedRegistration(): bool
    {
        return $this->registration_status === 'completed';
    }

    /**
     * Generate a new registration token.
     */
    public function generateRegistrationToken(): string
    {
        $this->registration_token = bin2hex(random_bytes(32));
        $this->registration_token_expires_at = now()->addMinutes(30);
        $this->save();

        return $this->registration_token;
    }

    /**
     * Get the user's emergency contacts.
     */
    public function emergencyContacts()
    {
        return $this->hasMany(UserEmergencyContact::class);
    }

    /**
     * Check if user is verified where user_infos nid_verification_status is 'verified'.
     */
    public function isVerified(): bool
    {
        return $this->userInfo->nid_verification_status === 'verified';
    }

    public function haveEmergencyContacts(): bool
    {
        return $this->emergencyContacts()->count() > 0;
    }

    /**
     * Get the user's help requests.
     */
    public function helpRequests()
    {
        return $this->hasMany(UserHelpRequest::class);
    }

    /**
     * Get the user's device tokens.
     */
    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    /**
     * Get the user's notifications.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function flagReports()
    {
        return $this->hasMany(UserRequestFlagReport::class, 'reported_by_user_id');
    }
}
