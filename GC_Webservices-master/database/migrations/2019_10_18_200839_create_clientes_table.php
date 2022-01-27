<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //metodo para agregar nuevas tablas
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes');
            $table->date('fecha_pago');
            $table->string('nota')->nullable();
            $table->unsignedInteger("id_cliente");
            $table->foreign("id_cliente")->references("id")->on("clientes_gym");
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
        Schema::dropIfExists('clientes');
    }
}
