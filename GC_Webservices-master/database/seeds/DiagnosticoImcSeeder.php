<?php

use Illuminate\Database\Seeder;

class DiagnosticoImcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {


        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Obesidad tipo III";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Obesidad tipo II";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Obesidad tipo I";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Preobesidad";
        $diagnosticoIMC->save();


        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Peso normal";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Delgadez";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Delgadez severa";
        $diagnosticoIMC->save();

        $diagnosticoIMC = new \App\Diagnostico_Imc();
        $diagnosticoIMC->diagnostico="Algo salio mal";
        $diagnosticoIMC->save();




    }
}
