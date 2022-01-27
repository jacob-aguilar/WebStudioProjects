<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesGinecologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes_ginecologicos', function (Blueprint $table) {
            $table->bigIncrements('id_antecedente__ginecologico');
            $table->string('edad_inicio_menstruacion')->nullable();
            $table->string('fum')->nullable();
            $table->string('citologia')->nullable();
            $table->string('fecha_citologia')->nullable();
            $table->string('resultado_citologia')->nullable();
            $table->string('duracion_ciclo_menstrual')->nullable();
            $table->string('periocidad_ciclo_menstrual')->nullable();
            $table->string('caracteristicas_ciclo_menstrual')->nullable();
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
        Schema::dropIfExists('antecedentes_ginecologicos');
    }
}
