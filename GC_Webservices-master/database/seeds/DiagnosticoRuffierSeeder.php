<?php

use App\DiagnosticoRuffier;
use Illuminate\Database\Seeder;

class DiagnosticoRuffierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Malo";
        $diagnostico->save();

        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Pobre";
        $diagnostico->save();

        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Regular";
        $diagnostico->save();

        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Bien";
        $diagnostico->save();

        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Excelente";
        $diagnostico->save();

        $diagnostico = new DiagnosticoRuffier();
        $diagnostico->diagnostico = "Algo salió mal";
        $diagnostico->save();


    }
}
