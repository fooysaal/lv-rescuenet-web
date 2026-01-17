<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequestFlagReport extends Model
{
    protected $fillable = [
        'user_help_request_id',
        'reported_by_user_id',
        'report_type',
        'report_reason',
        'attachment',
    ];

    public function userHelpRequest()
    {
        return $this->belongsTo(UserHelpRequest::class, 'user_help_request_id');
    }

    public function reportedByUser()
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }
}
