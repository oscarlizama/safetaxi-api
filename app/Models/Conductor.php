<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores';

    protected $fillable = [
        'fechaContratacion',
        'licenciaConducir',
        'dui',
        'archivoLicencia',
        'archivoDui',
        'estadoContratado',
        'user_id'
    ];

    public function vehiculo(){
        return $this->hasOne(Vehiculo::class);
    }

    public function horario(){
        return $this->hasMany(Horario::class);
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
