<?php

use Illuminate\Database\Seeder;

class SexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Sexos = array(

            'Hombre',
            'Mujer',

        );

        foreach($Sexos as $Sexo){
            DB::table('sexos')->insert([
                'sexo' => $Sexo,
            ]);
        }
    }
}
