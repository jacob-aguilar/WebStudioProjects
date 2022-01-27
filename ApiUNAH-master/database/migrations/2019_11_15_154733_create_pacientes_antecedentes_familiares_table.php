<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesAntecedentesFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_antecedentes_familiares', function (Blueprint $table) {
            $table->bigIncrements('id_paciente_antecedente_familiar');
            $table->bigInteger('id_paciente')->nullable();
            $table->bigInteger('id_enfermedad')->nullable();
            $table->bigInteger('id_parentesco')->nullable();
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
        Schema::dropIfExists('pacientes_antecedentes_familiares');
    }
}
