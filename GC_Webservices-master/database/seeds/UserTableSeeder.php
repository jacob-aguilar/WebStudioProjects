<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //Metodo utilizado para la accion de los sub procesos
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("secret");
        $user->save();
    }
}
