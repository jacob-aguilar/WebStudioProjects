<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(DiagnosticoGrasaTableSeeder::class);
        $this->call(CarrerasSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TipoClienteSeeder::class);
        $this->call(DiagnosticoRuffierSeeder::class);
        $this->call(DiagnosticoImcSeeder::class);
    }
}
