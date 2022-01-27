<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadisticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Metodo para agregar nuevas tablas
    public function up()
    {
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',50);
            $table->integer('edad');
            $table->char('identificacion', 11)->unique();
            $table->string('carrera_u_profesion', 100);
            $table->char('celular', 8);;
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
        Schema::dropIfExists('estadisticas');
    }
}
