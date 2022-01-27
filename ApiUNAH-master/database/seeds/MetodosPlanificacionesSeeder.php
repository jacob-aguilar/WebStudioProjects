<?php

use Illuminate\Database\Seeder;

class MetodosPlanificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodos_planificaciones = array(

            'DIU',
            'Condón',
            'Pastilla',
            'Implante',
            'Inyección trimestral',
            'Inyección trimestral',
            'Inyección mensual',
            'Ritmo',
            'Esterilización',

        );

        foreach($metodos_planificaciones as $metodo_planificacion){
            DB::table('metodos_planificaciones')->insert([
                'metodo_planificacion' => $metodo_planificacion,
            ]);
        }
    }
}
