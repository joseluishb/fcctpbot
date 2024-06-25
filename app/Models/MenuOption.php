<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    protected $fillable = ['desc_opcion', 'respuesta'];

    public function optionRoute()
    {
        return $this->hasOne(OptionCondition::class, 'menu_option_id');
    }

    public function subOptions()
    {
        return $this->hasMany(MenuOption::class, 'parent_id', 'id');
    }

    public function hasSubOptions()
    {
        return $this->subOptions()->exists();
    }
}
