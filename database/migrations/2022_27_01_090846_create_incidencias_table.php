<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
            $table->boolean('urgente');
            $table->string('estado');
            $table->longText('comentario')->nullable();
            $table->string('tipoaveria');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->unsignedBigInteger('ascensor_id');
            $table->foreign('ascensor_id')->references('id')->on('ascensors');

            $table->unsignedBigInteger('user_id');                      //cambio de ''tecnico_id'' a ''user_id'' por respetar los convencionalismos
            $table->foreign('user_id')->references('id')->on('users'); //sino algunas relaciones no funcionan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}
