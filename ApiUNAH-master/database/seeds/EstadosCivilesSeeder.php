<?php

use Illuminate\Database\Seeder;

class EstadosCivilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados_civiles = array(

            'Soltero',
            'Union Libre',
            'Divorciado',
            'Viudo',
            'Casado',

        );

        foreach($estados_civiles as $estado_civil){
            DB::table('estados_civiles')->insert([
                'estado_civil' => $estado_civil,
            ]);
        }


        
    }
}
