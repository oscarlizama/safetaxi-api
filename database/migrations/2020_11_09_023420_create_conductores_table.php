<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->date('fechaContratacion');
            $table->string('licenciaConducir', 17);
            $table->string('dui', 10);
            $table->string('archivoLicencia')->nullable();
            $table->string('archivoDui')->nullable();
            $table->boolean('estadoContratado')->default(1);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('conductores');
    }
}
