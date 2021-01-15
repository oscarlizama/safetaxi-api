<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('origenCoordenadas', 100);
            $table->string('destinoCoordenadas', 100);
            $table->string('origenTexto', 100);
            $table->string('destinoTexto', 100);
            $table->decimal('total', 8, 2);
            $table->date('fechaViaje')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->time('horaViaje')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('estadoViaje',5)->default('s');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('conductor_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conductor_id')->references('id')->on('conductores')->onDelete('cascade');
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
        Schema::dropIfExists('viajes');
    }
}
