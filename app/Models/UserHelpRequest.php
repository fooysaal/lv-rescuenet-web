<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHelpRequest extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'latitude',
        'longitude',
        'location_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(UserHelpRequestAttachment::class, 'help_request_id');
    }
}
