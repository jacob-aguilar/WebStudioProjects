<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes_personales', function (Blueprint $table) {
            $table->bigIncrements('id_antecedente_personal');
            $table->string('diabetes');
            $table->string('observacion_diabetes')->nullable();
            $table->string('tb_pulmonar');
            $table->string('observacion_tb_pulmonar')->nullable();
            $table->string('its');
            $table->string('observacion_its')->nullable();
            $table->string('desnutricion');
            $table->string('observacion_desnutricion')->nullable();
            $table->string('tipo_desnutricion')->nullable();
            $table->string('enfermedades_mentales');
            $table->string('observacion_enfermedades_mentales')->nullable();
            $table->string('tipo_enfermedad_mental')->nullable();
            $table->string('convulsiones');
            $table->string('observacion_convulsiones')->nullable();
            $table->string('alergias');
            $table->string('observacion_alergias')->nullable();
            $table->string('tipo_alergia')->nullable();
            $table->string('cancer');
            $table->string('observacion_cancer')->nullable();
            $table->string('tipo_cancer')->nullable();
            $table->string('hospitalarias_quirurgicas');
            $table->string('fecha_antecedente_hospitalario')->nullable();
            $table->string('tratamiento')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('tiempo_hospitalizacion')->nullable();
            $table->string('traumaticos');
            $table->string('observacion_traumaticos')->nullable();
            $table->string('otros')->nullable();
            $table->string('observacion_otros')->nullable();
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
        Schema::dropIfExists('antecedentes_personales');
    }
}
