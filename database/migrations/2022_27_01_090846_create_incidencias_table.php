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
            $table->timestamp('fecha-fin')->nullable();
            $table->boolean('urgente');
            $table->string('estado')->default('Pendiente');
            $table->longText('comentarioOperador')->nullable();
            $table->longText('comentarioTecnico')->nullable();
            $table->string('tipoaveria');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->unsignedBigInteger('ascensor_id');
            $table->foreign('ascensor_id')->references('id')->on('ascensors');

            $table->unsignedBigInteger('tecnico_id');
            $table->foreign('tecnico_id')->references('id')->on('users');
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
