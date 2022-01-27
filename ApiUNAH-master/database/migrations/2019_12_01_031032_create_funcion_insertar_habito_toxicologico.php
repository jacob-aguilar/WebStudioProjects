<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionInsertarHabitoToxicologico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $sql =

        'DROP FUNCTION IF EXISTS insertar_habito;

        ALTER DATABASE db_clinica CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
        ALTER TABLE habitos_toxicologicos CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        
        CREATE FUNCTION insertar_habito(h varchar(50)) returns int
            deterministic
        begin 
    
            IF(h not in (select habito_toxicologico from habitos_toxicologicos)) then
        
                insert into habitos_toxicologicos(habito_toxicologico) values (h);
            
            END IF;
        
        
            return (select id_habito_toxicologico from habitos_toxicologicos where habito_toxicologico = h);
       
        
        END';
        
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // esto no da !!
        DB::unprepared('drop function if exits insertar_habito');
    }
}
