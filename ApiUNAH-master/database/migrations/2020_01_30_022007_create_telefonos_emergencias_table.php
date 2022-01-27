<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonosEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos_emergencias', function (Blueprint $table) {
            $table->bigIncrements('id_telefono_emergencia');
            $table->bigInteger('id_paciente');
            $table->string('telefono_emergencia');
            $table->string('emergencia_persona');
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
        Schema::dropIfExists('telefonos_emergencias');
    }
}
