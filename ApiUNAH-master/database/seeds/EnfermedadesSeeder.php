<?php

use Illuminate\Database\Seeder;

class EnfermedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enfermedades = array(

            'Diabetes',
            'Tuberculosis pulmonar',
            'Convulsiones',
            'Alcoholismo o Sustancias psicoactivas',
            'Hipertensión arterial',
            'ITS/VIH',
            'Hospitalarias y Quirurgicas',
            'Traumáticos',
            

        );

        foreach($enfermedades as $enfermedad){
            DB::table('enfermedades')->insert([
                'enfermedad' => $enfermedad,
                'id_grupo_enfermedad' => 5,
            ]);
        }
    }
}
