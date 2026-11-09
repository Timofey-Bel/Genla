<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'email',
        'message',
        'action',
        'lab',
        'source',
        'status',
        'ip',
        'user_agent',
    ];
}
