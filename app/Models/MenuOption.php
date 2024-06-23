<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    public function optionRoute()
    {
        return $this->hasOne(OptionCondition::class, 'menu_option_id');
    }
}
