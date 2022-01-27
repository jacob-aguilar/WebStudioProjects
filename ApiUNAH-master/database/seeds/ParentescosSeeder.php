<?php

use Illuminate\Database\Seeder;

class ParentescosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentescos = array(

            'Padre',
            'Madre',
            'Tios',
            'Abuelos',
            'Otros',

        );

        foreach($parentescos as $parentesco){
            DB::table('parentescos')->insert([
                'parentesco' => $parentesco,
            ]);
        }
    }
}
