<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionInsertarEnfermedad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $available = Constant::PRODUCT_AVAILABLE_TRUE | Constant::PRODUCT_AVAILABLE_STOCK_TRUE;

        $sql = 

        'DROP FUNCTION IF EXISTS insertar_enfermedad;

        ALTER DATABASE db_clinica CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
        ALTER TABLE enfermedades CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        
        CREATE FUNCTION insertar_enfermedad(e varchar(50), id_grupo_e int) returns int
            deterministic
        begin 

            IF(e not in (select enfermedad from enfermedades)) then
            
                insert into enfermedades(enfermedad, id_grupo_enfermedad) values (e, id_grupo_e);

                
            END IF;
            
            
            return (select id_enfermedad from enfermedades where enfermedad = e);
        
            
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
        DB::unprepared('drop function if exits insertar_enfermedad');
    }
}
