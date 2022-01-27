<?php

use Illuminate\Database\Seeder;

class SegurosMedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seguros_medicos = array(

            'Privado',
            'IHSS',
            'No',

        );

        foreach($seguros_medicos as $seguro_medico){
            DB::table('seguros_medicos')->insert([
                'seguro_medico' => $seguro_medico,
            ]);
        }
    }
}
