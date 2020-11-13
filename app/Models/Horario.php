<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'dia',
        'horaInicio',
        'horaFin',
        'disponible',
        'conductor_id'
    ];

    public function conductor(){
        return $this->belongsTo(Conductor::class);
    }
    
}
