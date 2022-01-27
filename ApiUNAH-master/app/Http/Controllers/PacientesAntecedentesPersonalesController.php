<?php

namespace App\Http\Controllers;

use App\PacientesAntecedentesPersonales;
use Illuminate\Http\Request;
use DB;


class PacientesAntecedentesPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pacientes_antecedentes_personales = DB::table('pacientes')
            ->join('pacientes_antecedentes_personales',
             'pacientes.id_paciente', '=', 'pacientes_antecedentes_personales.id_paciente')
            ->join('enfermedades', 'enfermedades.id_enfermedad', '=', 'pacientes_antecedentes_personales.id_enfermedad')
            
            ->select(
                'pacientes.id_paciente',
                'enfermedades.enfermedad',
                'observacion'
                )
            ->get();

        echo json_encode($pacientes_antecedentes_personales);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente_antecedente_personal = new PacientesAntecedentesPersonales();
        $paciente_antecedente_personal->id_paciente = $request->input(['id_paciente']);
        $paciente_antecedente_personal->id_enfermedad = $request->input(['id_enfermedad']);
        $paciente_antecedente_personal->observacion = $request->input(['observacion']);
        $paciente_antecedente_personal->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PacientesAntecedentesPersonales  $pacientesAntecedentesPersonales
     * @return \Illuminate\Http\Response
     */
    public function show(PacientesAntecedentesPersonales $pacientesAntecedentesPersonales, $id_paciente)
    {
        // $paciente_antecedente_personal = DB::table('pacientes')
        //     ->join('pacientes_antecedentes_personales',
        //      'pacientes.id_paciente', '=', 'pacientes_antecedentes_personales.id_paciente')
        //     ->join('enfermedades', 'enfermedades.id_enfermedad', '=', 'pacientes_antecedentes_personales.id_enfermedad')
        //     ->where('pacientes.id_paciente', $id_paciente)    
        //     ->select(
        //         'pacientes.id_paciente',
        //         'enfermedades.enfermedad',
        //         'observacion'
        //         )
        //     ->get();

        $paciente_antecedente_personal = DB::select('SELECT  enfermedades.id_enfermedad,grupos_enfermedades.grupo_enfermedad,  enfermedades.enfermedad, pacientes_antecedentes_personales.observacion FROM pacientes_antecedentes_personales
        join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
        JOIN grupos_enfermedades ON grupos_enfermedades.id_grupo_enfermedad = enfermedades.id_grupo_enfermedad
         WHERE id_paciente = ?;', [$id_paciente]);

        echo json_encode($paciente_antecedente_personal);
    }

    // OBTENER LAS DESNUTRICIONES AP POR PACIENTE Y SOLO UNA
    public function obtenerdesnutricionAP( $id_paciente){
        $desnutricionAP = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 1 && id_paciente = ?', [$id_paciente]);        
                echo json_encode($desnutricionAP);
    }

    public function obtenerUnadesnutricionAP( $id_enfermedad){
        $desnutricionUnaAP = DB::select(
            'SELECT pacientes_antecedentes_personales.id_paciente_antecedente_personal, enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 1 && enfermedades.id_enfermedad = ?', [$id_enfermedad]);        
                echo json_encode($desnutricionUnaAP);
    }


  // OBTENER LAS ENFERMEDADES MENTALES AP POR PACIENTE Y SOLO UNA
    public function obtenermentalesAP( $id_paciente){
        $mentalAP = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 2 && id_paciente = ?', [$id_paciente]);        
                echo json_encode($mentalAP);
    }
    public function obtenerUnamentalesAP( $id_enfermedad){
        $mentalUnaAP = DB::select(
            'SELECT pacientes_antecedentes_personales.id_paciente_antecedente_personal, enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 2 && enfermedades.id_enfermedad = ?', [$id_enfermedad]);        
                echo json_encode($mentalUnaAP);
    }



      // OBTENER LAS ALERGIAS AP POR PACIENTE Y SOLO UNA
    public function obteneralergiasAP( $id_paciente){
        $alergiaAP = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 3 && id_paciente = ?', [$id_paciente]);        
                echo json_encode($alergiaAP);
    }
    public function obtenerUnaalergiasAP( $id_enfermedad){
        $alergiaUnaAP = DB::select(
            'SELECT pacientes_antecedentes_personales.id_paciente_antecedente_personal, enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 3 && enfermedades.id_enfermedad = ?', [$id_enfermedad]);        
                echo json_encode($alergiaUnaAP);
    }


      // OBTENER LOS CANCERES AP POR PACIENTE Y SOLO UNA
    public function obtenercanceresAP( $id_paciente){
        $cancerAP = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 4 && id_paciente = ?', [$id_paciente]);        
                echo json_encode($cancerAP);
    }
    public function obtenerUnacanceresAP( $id_enfermedad){
        $cancerUnaAP = DB::select(
            'SELECT pacientes_antecedentes_personales.id_paciente_antecedente_personal, enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 4 && enfermedades.id_enfermedad = ?', [$id_enfermedad]);        
                echo json_encode($cancerUnaAP);
    }


      // OBTENER OTRASENFERMEDADES AP POR PACIENTE Y SOLO UNA
    public function obtenerotrosAP( $id_paciente){
        $otrosAP = DB::select(
            'SELECT enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 5 && id_paciente = ?', [$id_paciente]);        
                echo json_encode($otrosAP);
    }
    public function obtenerUnaotrosAP( $id_enfermedad){
        $otrosUnaAP = DB::select(
            'SELECT pacientes_antecedentes_personales.id_paciente_antecedente_personal, enfermedades.id_enfermedad ,enfermedades.id_grupo_enfermedad, enfermedades.enfermedad,observacion FROM pacientes_antecedentes_personales 
                join enfermedades on pacientes_antecedentes_personales.id_enfermedad = enfermedades.id_enfermedad 
                 WHERE id_grupo_enfermedad = 5 && enfermedades.id_enfermedad = ?', [$id_enfermedad]);        
                echo json_encode($otrosUnaAP);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PacientesAntecedentesPersonales  $pacientesAntecedentesPersonales
     * @return \Illuminate\Http\Response
     */
    public function edit(PacientesAntecedentesPersonales $pacientesAntecedentesPersonales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacientesAntecedentesPersonales  $pacientesAntecedentesPersonales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_enfermedad_personal)
    {
        $observacion = $request->input(['observacion']);
        DB::table('pacientes_antecedentes_personales')
            ->where('id_enfermedad', $id_enfermedad_personal)
            ->update([               
                'observacion' => $observacion,
            ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacientesAntecedentesPersonales  $pacientesAntecedentesPersonales
     * @return \Illuminate\Http\Response
     */
    public function destroy( $pacientesAntecedentesPersonales)
    {
        DB::table('pacientes_antecedentes_personales')->where('id_enfermedad', $pacientesAntecedentesPersonales)->delete(); 
    }
}
