<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClientesGym extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // Metodo para agregar nuevas tablas
    public function up()
    {
        Schema::create('clientes_gym', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre',50);
            $table->date('fecha_nacimiento');
            $table->char('identificacion', 13)->unique()->nullable();
            $table->string('profesion_u_oficio', 100)->nullable();
            $table->unsignedInteger('id_carrera');
            $table->foreign("id_carrera")->references("id")->on("carreras");
            $table->unsignedInteger('id_tipo_cliente');
            $table->String('genero');
            $table->char('telefono', 8)->unique();
            $table->string("imagen")->nullable();
            $table->foreign("id_tipo_cliente")->references("id")->on("tipo_clientes");
            $table->timestamps();

        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Metodo para borrar tablas
    public function down()
    {
        Schema::dropIfExists('clientes_gym');

    }
}
