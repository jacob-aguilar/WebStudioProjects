<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionesFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificaciones_familiares', function (Blueprint $table) {
            $table->bigIncrements('id_planificacion_familiar');
            $table->string('planificacion_familiar');
            $table->integer('metodo_planificacion')->nullable();
            $table->string('observacion_planificacion')->nullable();
            $table->bigInteger('id_paciente')->nullable();
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
        Schema::dropIfExists('planificaciones_familiares');
    }
}
