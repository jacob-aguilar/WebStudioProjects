<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesHabitosToxicologicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_habitos_toxicologicos', function (Blueprint $table) {
            $table->bigIncrements('id_paciente_habito_toxicologico');
            $table->bigInteger('id_paciente');
            $table->bigInteger('id_habito_toxicologico');
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
        Schema::dropIfExists('pacientes_habitos_toxicologicos');
    }
}
