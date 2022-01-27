<?php

use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades = array(

            'Salud Pública',
            'Ginecología y Obstetricia',
            'Pediatría',
            'Cirugía General',
            'Medicina Interna',
            'Dermatología',
            'Neurología',
            'Neurocirugía ',
            'Cirugía Plástica ',
            'Anestesiología, Reanimación y Dolor',
            'Ortopedia',
            'Psiquiatría',
            'Otorrinolaringología',
            'Medicina Física y Rehabilitación',

        );

        foreach($especialidades as $especialidad){
            DB::table('especialidades')->insert([
                'especialidad' => $especialidad,
            ]);
        }
    }
}
