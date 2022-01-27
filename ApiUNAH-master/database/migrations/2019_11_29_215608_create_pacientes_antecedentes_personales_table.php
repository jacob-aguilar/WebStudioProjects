<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesAntecedentesPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_antecedentes_personales', function (Blueprint $table) {
            $table->bigIncrements('id_paciente_antecedente_personal');
            $table->bigInteger('id_paciente');
            $table->bigInteger('id_enfermedad');
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('pacientes_antecedentes_personales');
    }
}
