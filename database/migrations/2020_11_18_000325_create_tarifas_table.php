<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('criterio', 50);
            $table->float('valor', 8, 2);
            $table->unsignedInteger('identificar');
            $table->date('fechaInicioTarifa')->nullable();
            $table->date('fechaFinTarifa')->nullable();
            $table->time('horaInicioTarifa')->nullable();
            $table->time('horaFinTarifa')->nullable();
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
        Schema::dropIfExists('tarifas');
    }
}
