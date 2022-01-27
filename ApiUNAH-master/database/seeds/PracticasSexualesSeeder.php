<?php

use Illuminate\Database\Seeder;

class PracticasSexualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practicas_sexuales = array(

            'Anal',
            'Vaginal',
            'Oral'

        );

        foreach($practicas_sexuales as $practica_sexual){
            DB::table('practicas_sexuales')->insert([
                'practicas_sexuales_riesgo' => $practica_sexual,
            ]);
        }
    }
}
