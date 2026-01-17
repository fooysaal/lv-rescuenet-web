<?php

namespace App\Models;

use App\Models\UserHelpRequestLog;
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

    public function requestLogs()
    {
        return $this->hasMany(UserHelpRequestLog::class, 'help_request_id');
    }

    public function flagReports()
    {
        return $this->hasMany(UserRequestFlagReport::class, 'user_help_request_id');
    }
}
