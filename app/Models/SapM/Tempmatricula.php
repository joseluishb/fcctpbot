<?php

namespace App\Models\SapM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempmatricula extends Model
{
    protected $connection = 'master_database';
    protected $table = 'm_temp_matricula';
    protected $primaryKey = 'nummat';

}

