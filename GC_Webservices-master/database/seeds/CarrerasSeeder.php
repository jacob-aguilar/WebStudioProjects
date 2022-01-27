<?php

use App\Carrera;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        $carrera = new Carrera();
        $carrera->carrera = "Ninguna";
        $carrera->save();

        $carrera = new Carrera();
        $carrera->carrera = "Lic. Informática Administrativa";
        $carrera->save();

        $carrera = new Carrera();
        $carrera->carrera = "Ing. Agroindustrial";
        $carrera->save();

        $carrera = new Carrera();
        $carrera->carrera = "Lic. Enfermeria";
        $carrera->save();

        $carrera = new Carrera();
        $carrera->carrera = "TUAEC";
        $carrera->save();

        $carrera = new Carrera();
        $carrera->carrera = "Otros";
        $carrera->save();
    }
}
