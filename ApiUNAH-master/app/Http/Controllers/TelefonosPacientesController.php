<?php

namespace App\Http\Controllers;

use App\TelefonosPacientes;
use DB;
use Illuminate\Http\Request;

class TelefonosPacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    {
        $telefonos_pacientes = DB::table('telefonos_pacientes')
        ->select('id_paciente','id_telefono_paciente','telefono')
        ->get();
        return response()->json($telefonos_pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $datos_validados = $request->validate([
            'id_paciente' => 'required',
            'telefono' => ['unique:telefonos_pacientes', 'required', 'regex:/^\d{8}$/']
        ]);

        $telefono_paciente = new TelefonosPacientes();
        $telefono_paciente->id_paciente = $datos_validados['id_paciente'];
        $telefono_paciente->telefono = $datos_validados['telefono'];
        $telefono_paciente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TelefonosPacientes  $telefonosPacientes
     * @return \Illuminate\Http\Response
     */
    public function show( $id_paciente)    {
        $telefonoPaciente = DB::select(
            'SELECT id_telefono_paciente, telefono
             FROM telefonos_pacientes
             WHERE id_paciente = ? 
            ', [$id_paciente]);
            echo json_encode($telefonoPaciente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TelefonosPacientes  $telefonosPacientes
     * @return \Illuminate\Http\Response
     */
    public function edit(TelefonosPacientes $telefonosPacientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TelefonosPacientes  $telefonosPacientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonosPacientes $telefonosPacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TelefonosPacientes  $telefonosPacientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_telefono)    {
        DB::table('telefonos_pacientes')->where('id_telefono_paciente', $id_telefono)->delete(); 
    }
}
