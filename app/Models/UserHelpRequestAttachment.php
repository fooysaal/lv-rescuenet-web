<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHelpRequestAttachment extends Model
{
    protected $fillable = [
        'help_request_id',
        'file_path',
        'file_type',
    ];

    public function helpRequest()
    {
        return $this->belongsTo(UserHelpRequest::class, 'help_request_id');
    }
}
