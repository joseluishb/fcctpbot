<?php

namespace App\Models\SapM;

use Illuminate\Database\Eloquent\Model;

class CronogramaMatricula extends Model
{
    protected $connection = 'master_database';
    protected $table = 'm_cronograma_matricula';
    protected $primaryKey = 'id_actividad';
}
