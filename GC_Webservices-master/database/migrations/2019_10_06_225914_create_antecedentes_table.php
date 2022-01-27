<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Metodo para agregar nuevas tablas
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->increments('id');
            $table->double('peso');
            $table->double('altura');
            $table->double('imc');
            $table->unsignedInteger('id_diagnostico');
            $table->double('pecho');
            $table->double('brazo');
            $table->double('ABD_A');
            $table->double('ABD_B');
            $table->double('cadera');
            $table->double('muslo');
            $table->double('pierna');
            $table->unsignedInteger("id_cliente");
            $table->foreign("id_cliente")->references("id")->on("clientes_gym");
            $table->foreign("id_diagnostico")->references("id")->on("diagnostico_imcs");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Metodo para borrar tablas
    public function down()
    {
        Schema::dropIfExists('antecedentes');
    }
}
