<?php

namespace App\Http\Controllers;

use App\PacientesHabitosToxicologicos;
use Illuminate\Http\Request;
use DB;


class PacientesHabitosToxicologicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes_habitos_toxicologicos = DB::table('pacientes')
            ->join('pacientes_habitos_toxicologicos',
                'pacientes.id_paciente', '=', 'pacientes_habitos_toxicologicos.id_paciente')
            ->join('habitos_toxicologicos', 
                'habitos_toxicologicos.id_habito_toxicologico', '=', 'pacientes_habitos_toxicologicos.id_habito_toxicologico')
            
            ->select(
                'id_paciente_habito_toxicologico',
                'pacientes.id_paciente',
                'habitos_toxicologicos.habito_toxicologico',
                'observacion'
                )
            ->get();

        echo json_encode($pacientes_habitos_toxicologicos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente_habito_toxicologico = new PacientesHabitosToxicologicos();
        $paciente_habito_toxicologico->id_paciente = $request->input(['id_paciente']);
        $paciente_habito_toxicologico->id_habito_toxicologico = $request->input(['id_habito_toxicologico']);
        $paciente_habito_toxicologico->observacion = $request->input(['observacion']);

        $paciente_habito_toxicologico->save();
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\PacientesHabitosToxicologicos  $pacientesHabitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function show(PacientesHabitosToxicologicos $pacientesHabitosToxicologicos, $id_paciente)
    {
        $toxicologicos= DB::select('SELECT pacientes_habitos_toxicologicos.id_paciente_habito_toxicologico,pacientes_habitos_toxicologicos.id_paciente, habitos_toxicologicos.habito_toxicologico, pacientes_habitos_toxicologicos.observacion FROM pacientes_habitos_toxicologicos
        join habitos_toxicologicos on pacientes_habitos_toxicologicos.id_habito_toxicologico = habitos_toxicologicos.id_habito_toxicologico 
         WHERE id_paciente = ?;',[$id_paciente]);

        echo json_encode($toxicologicos);
    }

    public function obtenerUnhabito(PacientesHabitosToxicologicos $pacientesHabitosToxicologicos, $id_paciente_habito_toxicologico)
    {
        $toxicologicos= DB::select('SELECT habitos_toxicologicos.id_habito_toxicologico,pacientes_habitos_toxicologicos.id_paciente_habito_toxicologico,pacientes_habitos_toxicologicos.id_paciente, habitos_toxicologicos.habito_toxicologico, pacientes_habitos_toxicologicos.observacion FROM pacientes_habitos_toxicologicos
        join habitos_toxicologicos on pacientes_habitos_toxicologicos.id_habito_toxicologico = habitos_toxicologicos.id_habito_toxicologico 
         WHERE id_paciente_habito_toxicologico = ?;',[$id_paciente_habito_toxicologico]);

        echo json_encode($toxicologicos);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PacientesHabitosToxicologicos  $pacientesHabitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_habito_toxicologico)    {       
        $observacion = $request->input(['observacion']);
        DB::table('pacientes_habitos_toxicologicos')
            ->where('id_paciente_habito_toxicologico', $id_habito_toxicologico)
            ->update([               
                'observacion' => $observacion,
            ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PacientesHabitosToxicologicos  $pacientesHabitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function destroy( $pacientesHabitosToxicologicos)
    {
        DB::table('pacientes_habitos_toxicologicos')->where('id_paciente_habito_toxicologico', $pacientesHabitosToxicologicos)->delete(); 
    }
}
