<?php

namespace App\Http\Controllers;

use App\PacientesAntecedentesFamiliares;
use DB;
use Illuminate\Http\Request;

class PacientesAntecedentesFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pacientesAntecedentesFamiliares = PacientesAntecedentesFamiliares::get();

        // echo json_encode($pacientesAntecedentesFamiliares);

        $pacientesAntecedentesFamiliares = DB::table('pacientes')
            ->join('pacientes_antecedentes_familiares','pacientes.id_paciente', '=', 'pacientes_antecedentes_familiares.id_paciente')
            ->join('enfermedades', 'enfermedades.id_enfermedad', '=', 'pacientes_antecedentes_familiares.id_enfermedad')
            ->join('parentescos', 'parentescos.id_parentesco', '=', 'pacientes_antecedentes_familiares.id_parentesco')
            
            ->select(
                'pacientes.id_paciente',
                'enfermedades.enfermedad',
                'parentescos.parentesco'
                )
            ->get();

        echo json_encode($pacientesAntecedentesFamiliares);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pacienteAntecedenteFamiliar = new PacientesAntecedentesFamiliares();
        
        $pacienteAntecedenteFamiliar->id_paciente = $request->input(['id_paciente']);
        $pacienteAntecedenteFamiliar->id_enfermedad = $request->input(['id_enfermedad']);
        $pacienteAntecedenteFamiliar->id_parentesco = $request->input(['id_parentesco']);

        $pacienteAntecedenteFamiliar->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PacientesAntecedentesFamiliares  $pacientesAntecedentesFamiliares
     * @return \Illuminate\Http\Response
     */

    public function show($id_paciente)
    {
        // $pacienteAntecedenteFamiliar = DB::table('pacientes')
        //     ->join('pacientes_antecedentes_familiares',
        //      'pacientes.id_paciente', '=', 'pacientes_antecedentes_familiares.id_paciente')
        //     ->join('enfermedades', 'enfermedades.id_enfermedad', '=', 'pacientes_antecedentes_familiares.id_enfermedad')
        //     ->join('parentescos', 'parentescos.id_parentesco', '=', 'pacientes_antecedentes_familiares.id_parentesco')
        //     ->where('pacientes.id_paciente', $id_paciente)
            
        //     ->select(
        //         'pacientes.id_paciente',
        //         'enfermedades.enfermedad',
        //         'parentescos.parentesco'
        //         )
        //     ->get();


        $pacienteAntecedenteFamiliar = DB::select(
    'SELECT  grupos_enfermedades.grupo_enfermedad,  enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
        join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
        JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
        JOIN grupos_enfermedades ON grupos_enfermedades.id_grupo_enfermedad = enfermedades.id_grupo_enfermedad
         WHERE id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);

        echo json_encode($pacienteAntecedenteFamiliar);
    }

    public function obtenerdesnutricionAF( $id_paciente){
        $desnutricionAF = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
                join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
                JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
                 WHERE id_grupo_enfermedad = 1 && id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);
        
                echo json_encode($desnutricionAF);
    }
    public function obtenermentalesAF( $id_paciente){
        $mentalesAF = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
                join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
                JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
                 WHERE id_grupo_enfermedad = 2 && id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);
        
                echo json_encode($mentalesAF);
    }
    public function obteneralergiasAF( $id_paciente){
        $alergiasAF = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
                join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
                JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
                 WHERE id_grupo_enfermedad = 3 && id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);
        
                echo json_encode($alergiasAF);
    }
    public function obtenercanceresAF( $id_paciente){
        $canceresAF = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
                join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
                JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
                 WHERE id_grupo_enfermedad = 4 && id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);
        
                echo json_encode($canceresAF);
    }
    public function obtenerotrosAF( $id_paciente){
        $otrosAF = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad, GROUP_CONCAT(parentescos.parentesco) AS parentesco FROM pacientes_antecedentes_familiares 
                join enfermedades on pacientes_antecedentes_familiares.id_enfermedad = enfermedades.id_enfermedad 
                JOIN parentescos ON pacientes_antecedentes_familiares.id_parentesco = parentescos.id_parentesco
                 WHERE id_grupo_enfermedad = 5 && id_paciente = ? GROUP BY pacientes_antecedentes_familiares.id_enfermedad', [$id_paciente]);
        
                echo json_encode($otrosAF);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacientesAntecedentesFamiliares  $pacientesAntecedentesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PacientesAntecedentesFamiliares $pacientesAntecedentesFamiliares)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacientesAntecedentesFamiliares  $pacientesAntecedentesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function destroy( $pacientesAntecedentesFamiliares)
    {
        DB::table('pacientes_antecedentes_familiares')->where('id_enfermedad', $pacientesAntecedentesFamiliares)->delete(); 
    }
}
