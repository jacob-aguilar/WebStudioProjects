<?php

namespace App\Http\Controllers;

use App\HabitosToxicologicos;
use database\funciones\insertarHabito;
use DB;

use Illuminate\Http\Request;

class HabitosToxicologicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habito_toxicologicos = HabitosToxicologicos::get();
        response()->json($habito_toxicologicos);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datos_validados = $request->validate([
            'habito_toxicologico' => 'required',
        ]);

        $insertarHabito = new insertarHabito();
        $habito_toxicologico = $datos_validados['habito_toxicologico'];
        $id_habito_toxicologico = $insertarHabito->ejecutar($habito_toxicologico);
        return response()->json($id_habito_toxicologico);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HabitosToxicologicos  $habitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function show(HabitosToxicologicos $habitosToxicologicos,$id_habito_toxicologico)    {
        $toxicologicos= DB::select('SELECT id_habito_toxicologico,habito_toxicologico
        FROM habitos_toxicologicos
         WHERE id_habito_toxicologico = ?;',[$id_habito_toxicologico]);
        echo json_encode($toxicologicos);
    }


    public function obtenerColumnaHabitoToxicologico(){
        $habitoS_toxicologicos = DB::table('habitos_toxicologicos')->select('habito_toxicologico')->get();        
        return response()->json($habitoS_toxicologicos);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HabitosToxicologicos  $habitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_habito_toxicologico)    {
        $habito_toxicologico = $request->input(['habito_toxicologico']);

        DB::table('habitos_toxicologicos')
        ->where('id_habito_toxicologico', $id_habito_toxicologico)
        ->update([
            'habito_toxicologico'=> $habito_toxicologico,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HabitosToxicologicos  $habitosToxicologicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(HabitosToxicologicos $habitosToxicologicos)
    {
       
    }
}
