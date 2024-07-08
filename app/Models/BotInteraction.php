<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotInteraction extends Model
{
    protected $fillable = [
        'bot_session_id',
        'session_id',
        'uuid',
        'doc_number',
        'interaction_type',
        'option_selected',
        'option_parent',
        'response'
    ];
}
