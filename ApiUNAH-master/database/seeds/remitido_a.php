<?php

use Illuminate\Database\Seeder;

class remitido_a extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secciones = array(

            'Psicologia',
            'Nutricion',
            'Odontologia',
            'Terapia Funcional',
            'CATFA',
            'Trabajo Social',
            ' '

        );

        foreach($secciones as $seccion){
            DB::table('remitidoA')->insert([
                'Seccion' => $seccion,
            ]);
        }




    }
}
