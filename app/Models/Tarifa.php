<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $fillable = [
        'criterio',
        'valor',
        'identificar',
        'fechaInicioTarifa',
        'fachaFinTarifa',
        'horaInicioTarifa',
        'horaFinTarifa'
    ];
    
}
