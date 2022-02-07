<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAscensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ascensors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numeroserie');
            $table->string('calle');
            $table->integer('bloque');
            $table->integer('paradas');
            $table->float('recorrido');

            $table->unsignedBigInteger('zona_id');
            $table->foreign('zona_id')->references('id')->on('zonas');

            $table->unsignedBigInteger('modelo_ascensor_id');
            $table->foreign('modelo_ascensor_id')->references('id')->on('modelo_ascensors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ascensors');
    }
}
