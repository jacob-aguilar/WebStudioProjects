<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesObstetricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes_obstetricos', function (Blueprint $table) {
            $table->bigIncrements('id_antecedente_obstetrico');
            $table->string('partos')->nullable();
            $table->string('abortos')->nullable();
            $table->string('cesarias')->nullable();
            $table->string('hijos_vivos')->nullable();
            $table->string('hijos_muertos')->nullable();
            $table->string('fecha_termino_ult_embarazo')->nullable();
            $table->string('descripcion_termino_ult_embarazo')->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('antecedentes_obstetricos');
    }
}
