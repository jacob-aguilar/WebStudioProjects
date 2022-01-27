<?php

use Illuminate\Database\Seeder;

class HabitosToxicologicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $habitos_toxicologicos = array(

            'Alcohol',
            'Tabaquismo',
            'Marihuana',
            'Cocaína',
            

        );

        foreach($habitos_toxicologicos as $habito_toxicologico){
            DB::table('habitos_toxicologicos')->insert([
                'habito_toxicologico' => $habito_toxicologico,
            ]);
        }
    }
}
