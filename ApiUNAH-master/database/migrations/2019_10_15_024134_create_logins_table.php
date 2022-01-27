<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->bigIncrements('id_login');
            $table->string('cuenta');
            $table->string('password');
            $table->string('nombre')->nullable();
            $table->string('carrera')->nullable();
            $table->string('centro')->nullable();
            $table->string('numero_identidad')->nullable();
            $table->longText('imagen')->nullable();
            $table->bigInteger('id_rol')->nullable();

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
        Schema::dropIfExists('logins');
    }
}
