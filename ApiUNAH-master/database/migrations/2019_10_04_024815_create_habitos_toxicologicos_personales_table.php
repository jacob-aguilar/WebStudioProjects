<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitosToxicologicosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitos_toxicologicos_personales', function (Blueprint $table) {
            $table->bigIncrements('id_habito_toxicologico_personal');
            $table->string('alcohol');
            $table->string('observacion_alcohol')->nullable();
            $table->string('tabaquismo');
            $table->string('observacion_tabaquismo')->nullable();
            $table->string('marihuana');
            $table->string('observacion_marihuana')->nullable();
            $table->string('cocaina');
            $table->string('observacion_cocaina')->nullable();
            $table->string('otros')->nullable();
            $table->string('observacion_otros')->nullable();
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
        Schema::dropIfExists('habitos_toxicologicos_personales');
    }
}
