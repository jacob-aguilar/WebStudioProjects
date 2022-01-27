<?php

namespace App\Http\Controllers;

use App\TelefonosEmergencia;
use DB;
use Illuminate\Http\Request;

class TelefonosEmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $telefonos_emergencia = TelefonosEmergencia::get();
        echo json_encode($telefonos_emergencia);    
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        $telefono_emergencia = new TelefonosEmergencia();
        $telefono_emergencia->id_paciente = $request->input(['id_paciente']);
        $telefono_emergencia->telefono_emergencia =$request->input(['telefono_emergencia']);
        $telefono_emergencia->emergencia_persona =$request->input(['emergencia_persona']);
        $telefono_emergencia->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TelefonosEmergencia  $telefonosEmergencia
     * @return \Illuminate\Http\Response
     */
    public function show($id_paciente)    {
        $telefonosEmergencia = DB::select(
        'SELECT id_telefono_emergencia, telefono_emergencia, emergencia_persona
         FROM telefonos_emergencias
         WHERE id_paciente = ? 
        ', [$id_paciente]);
        echo json_encode($telefonosEmergencia);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TelefonosEmergencia  $telefonosEmergencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonosEmergencia $telefonosEmergencia)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TelefonosEmergencia  $telefonosEmergencia
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_telefono_emergencia){
        DB::table('telefonos_emergencias')->where('id_telefono_emergencia', $id_telefono_emergencia)->delete(); 
    }
}

