<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    
    protected $fillable = [
        'id',
        'matricula',
        'capacidad',
        'numeroChasis',
        'anio',
        'marca',
        'modelo',
        'tipoVehiculo',
        'clase',
        'color',
        'numeroTarjetaCirculacion',
        'archivoTarjetaCirculacion',
        'enServicio'
    ];


    public function conductor(){
        return $this->belongsTo(Conductor::class);
    }

}
