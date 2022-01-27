<?php

use Illuminate\Database\Seeder;

class InventariosPresentacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventarios_presentaciones = array(

            'Tabletas',
            'Cápsulas',
            'Comprimidos',
            'Sobres',
            'Jarabe',
            'Crema',
            'Supositorio',
            'Óvulo',
            'Suspencion',
            'Solución',
            'Inyectable',

        );

        foreach($inventarios_presentaciones as $inventario_presentacion){
            DB::table('inventarios_presentaciones')->insert([
                'presentacion' => $inventario_presentacion,
            ]);
        }
    }
}
