<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadSexualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_sexuals', function (Blueprint $table) {
            $table->bigIncrements('id_actividad_sexual');
            $table->string('actividad_sexual');
            $table->string('edad_inicio_sexual')->nullable();
            $table->string('numero_parejas_sexuales')->nullable();
            $table->integer('practicas_sexuales_riesgo')->nullable();
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
        Schema::dropIfExists('actividad_sexuals');
    }
}
