<?php

namespace App\Models\SapM;

use Illuminate\Database\Eloquent\Model;

class TMenuBot extends Model
{
    protected $connection = 'master_database';
    protected $table = 't_menu_bot';
    protected $primaryKey = 'id_menu';

    public $timestamps = false;


    public function parent()
    {
        return $this->belongsTo(TMenuBot::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(TMenuBot::class, 'parent_id');
    }
}
