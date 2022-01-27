<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesHospitalariasQuirurgicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_hospitalarias_quirurgicas', function (Blueprint $table) {
            $table->bigIncrements('id_hospitalaria_quirurgica');
            $table->bigInteger('id_paciente');
            $table->string('fecha');
            $table->string('tiempo_hospitalizacion');
            $table->string('diagnostico');
            $table->string('tratamiento');
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
        Schema::dropIfExists('pacientes_hospitalarias_quirurgicas');
    }
}
