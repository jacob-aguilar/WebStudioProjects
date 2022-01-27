<?php

use Illuminate\Database\Seeder;

class GruposEnfermedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $grupos_enfermedades = array(

            'Desnutrición',
            'Enfermedades Mentales',
            'Alergias',
            'Cáncer',
            'Otros',

        );

        foreach($grupos_enfermedades as $grupo_enfermedad){
            DB::table('grupos_enfermedades')->insert([
                'grupo_enfermedad' => $grupo_enfermedad,
                
            ]);
        }
        
    }
}
