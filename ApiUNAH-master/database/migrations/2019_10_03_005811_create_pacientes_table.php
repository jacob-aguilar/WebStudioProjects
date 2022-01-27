<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id_paciente');
            $table->string('numero_paciente')->unique()->nullable();
            $table->string('nombre_completo');
            $table->string('correo_electronico')->unique()->nullable();
            $table->string('numero_cuenta')->unique()->nullable();
            $table->string('numero_identidad')->unique();
            $table->longText('imagen')->nullable();
            $table->string('lugar_procedencia');
            $table->string('direccion');
            $table->string('carrera')->nullable();
            $table->string('fecha_nacimiento');
            $table->string('sexo');
            $table->integer('estado_civil');
            $table->integer('seguro_medico');
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();
            $table->string('imc')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('presion')->nullable();
            $table->string('pulso')->nullable();
            $table->integer('categoria'); 
            $table->string('prosene')->nullable();           
            $table->timestamps();

            // $table->primary('id_paciente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
