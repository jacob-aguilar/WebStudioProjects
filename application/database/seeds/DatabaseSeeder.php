<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AlumnosTableSeeder::class);
         $this->call(SeccionesTableSeeder::class);
         $this->call(AlumnoSeccionTableSeeder::class);

    }
}
