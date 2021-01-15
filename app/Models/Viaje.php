<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    //use HasFactory;
    protected $fillable = [
        'id',
        'origenCoordenadas',
        'destinoCoordenadas',
        'origenTexto',
        'destinoTexto',
        'total',
        'fechaViaje',
        'horaViaje',
        'user_id',
        'conductor_id',
        'estadoViaje'
    ];

    public function conductor(){
        return $this->belongsTo(Conductor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
