<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmergencyContact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'phone',
    ];

    /**
     * Get the user that owns the emergency contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
