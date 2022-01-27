<?php

use Faker\Generator as Faker;
use App\Seccion;
/*
*
*
*
			$table->string('correlativo');
            $table->string('codigo_asignatura');
            $table->string('edificio');
            $table->string('aula');
            $table->string('hora_inicio');
            $table->string('hora_fin');
*/


$factory->define(Seccion::class, function (Faker $faker) {
    return [
        'correlativo'=>$faker->numberBetween(1200, 24000),
        'codigo_asignatura'=>$faker->bothify('???-###'),
        'edificio'=>$faker->randomElement(['1', 'Laboratorio', 'Planta', 'Deportes', 'Coyotera']),
        'aula'=>$faker->numberBetween(1,2).$faker->numerify('##'),
        'hora_inicio'=>$faker->numberBetween(7,19)."00",
        'hora_fin'=>$faker->numberBetween(8,20)."00"
    ];
});
