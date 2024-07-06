<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotSession extends Model
{
    protected $fillable = [
        'session_id',
        'uuid',
        'started_at',
        'ended_at',
    ];
}
