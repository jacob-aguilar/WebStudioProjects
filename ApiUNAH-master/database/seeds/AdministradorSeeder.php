<?php

use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('administradores')->insert([
            'usuario' => 'admin',
            'nombre_completo' => 'admin',
            'identidad' => '0000000000000',
        ]);

        DB::table('logins')->insert([
            'cuenta' => 'admin',
            'password' => bcrypt('admin'),
            'id_rol' => '2'
        ]);

    }
}
