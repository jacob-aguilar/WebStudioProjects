<?php

use Faker\Generator as Faker;
use App\Alumno;
$factory->define(Alumno::class, function (Faker $faker) {
    return [
        //
    'nombres'=> $faker->firstName.' '.$faker->firstName,
    'apellidos'=> $faker->lastName.' '.$faker->lastName,
    //2000-2019|25|[0,3]|cuatro digitos
    'cuenta'=>$faker->numberBetween(2000, 2019).'25'.$faker->randomElement(['0', '3']).$faker->numerify('####'),
    'correo'=>$faker->unique()->freeEmail,
    // 
    'fecha_nacimiento'=>$faker->dateTimeBetween('-25 years', '-16 years'),
    'identidad'=>$faker->randomElement(['0','1']).$faker->randomElement(['0','1','2','3','4','5','6','7','8'])
    .$faker->numerify('##').$faker->numberBetween(1985, 2003).$faker->numerify('#####'), 
     'activo'=>$faker->boolean,
     //maxdecimales , min, max
     'deuda'=>$faker->randomFloat(2, 0, 500),
     'genero'=>$faker->randomElement(['f','m']),
      'foto'=>$faker->imageUrl($width = 640, $height= 400)
    ];
});
