<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Categorias = array(

            'Empleado',
            'Visitante',
            'Estudiante',
            

        );

        foreach($Categorias as $Categoria){
            DB::table('categorias')->insert([
                'categoria' => $Categoria,
            ]);
        }
    
    }
}
