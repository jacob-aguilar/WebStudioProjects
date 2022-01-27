<?php

use Illuminate\Database\Seeder;

class AlumnoSeccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i<100; $i++){
        	for($j=1; $j<=5; $j++){
        		DB::table('alumno_seccion')->insert(
        			[
        			'alumno_id'=> $i,
        			'seccion_id'=>rand(1, 50)
        			]
        			);
        	}
        }

    }
}
