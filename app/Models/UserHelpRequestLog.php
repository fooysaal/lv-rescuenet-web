<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserHelpRequest;
use Illuminate\Database\Eloquent\Model;

class UserHelpRequestLog extends Model
{
    protected $fillable = [
        'help_request_id',
        'performed_by',
        'action',
        'note',
    ];

    public function helpRequest()
    {
        return $this->belongsTo(UserHelpRequest::class, 'help_request_id');
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
