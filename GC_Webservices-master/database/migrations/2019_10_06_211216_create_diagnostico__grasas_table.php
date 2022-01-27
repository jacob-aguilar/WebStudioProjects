<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticoGrasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Metodo para agregar nuevas tablas
    public function up()
    {
        Schema::create('diagnostico_grasas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('diagnostico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Metodo para borrar
    public function down()
    {
        Schema::dropIfExists('diagnostico_grasas');
    }
}
