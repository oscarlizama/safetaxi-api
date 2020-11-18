<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 7);
            $table->unsignedInteger('capacidad');
            $table->string('numeroChasis', 7);
            $table->unsignedInteger('anio');
            $table->string('marca', 25);
            $table->string('modelo', 25);
            $table->string('tipoVehiculo', 15);
            $table->string('clase', 15);
            $table->string('color', 20);
            $table->string('numeroTarjetaCirculacion', 20);
            $table->bigInteger('conductor_id')->nullable()->unsigned();
            $table->foreign('conductor_id')->references('id')->on('conductores')->onDelete('cascade');
            $table->boolean('enServicio', 20)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
