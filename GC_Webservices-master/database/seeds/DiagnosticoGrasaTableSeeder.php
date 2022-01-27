<?php

use App\Diagnostico_Grasas;
use Illuminate\Database\Seeder;

class DiagnosticoGrasaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico ="Estas Obeso";
        $diagnostico->save();

        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico = "Tienes que perder grasa";
        $diagnostico->save();

        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico ="Porcentaje aceptable";
        $diagnostico->save();

        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico = "En forma";
        $diagnostico->save();

        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico ="Eres un atleta";
        $diagnostico->save();

        $diagnostico = new Diagnostico_Grasas();
        $diagnostico->diagnostico = "Algo salio mal";
        $diagnostico->save();
    }
}
