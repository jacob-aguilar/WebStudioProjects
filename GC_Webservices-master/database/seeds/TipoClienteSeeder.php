<?php

use Illuminate\Database\Seeder;
use App\Tipo_Cliente;
class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        $tipo = new Tipo_Cliente();
        $tipo->descripcion= "Estudiante";
        $tipo->save();


        $tipo = new Tipo_Cliente();
        $tipo->descripcion= "Docente";
        $tipo->save();


        $tipo = new Tipo_Cliente();
        $tipo->descripcion= "Particular";
        $tipo->save();
    }
}
