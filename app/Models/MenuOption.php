<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuOption extends Model
{
    use SoftDeletes;

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
