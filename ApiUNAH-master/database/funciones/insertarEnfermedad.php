<?php

namespace database\funciones;
use DB;


class insertarEnfermedad{

    public function ejecutar($enfermedad, $id_grupo_enfermedad)
    {
        // return DB::select('select insertar_antecedente(?)',[$antecedente])->first(); 
        return DB::select('SELECT insertar_enfermedad(?, ?) as id_enfermedad', [$enfermedad, $id_grupo_enfermedad]);

       

    }
}