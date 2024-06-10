<?php

namespace App\Models\SapM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'master_database';
    protected $table = 'm_cliente';
    protected $primaryKey = 'nummat';
    protected $keyType = 'string';
}


