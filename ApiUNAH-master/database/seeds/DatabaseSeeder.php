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
        // $this->call(UsersTableSeeder::class);
         $this->call(EstadosCivilesSeeder::class);
         $this->call(SegurosMedicosSeeder::class);
         $this->call(InventariosPresentacionesSeeder::class);
         $this->call(EspecialidadesSeeder::class);
         $this->call(PracticasSexualesSeeder::class);
         $this->call(MetodosPlanificacionesSeeder::class);
         $this->call(EnfermedadesSeeder::class);
         $this->call(ParentescosSeeder::class);
         $this->call(SexosSeeder::class);
         $this->call(remitido_a::class);
         $this->call(GruposEnfermedadesSeeder::class);
         $this->call(HabitosToxicologicosSeeder::class);
         $this->call(CategoriasSeeder::class);
         $this->call(AdministradorSeeder::class);
         $this->call(RolesSeeder::class);

         
         
         
    }
}
