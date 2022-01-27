<?php

namespace App\Http\Controllers;

use App\habitosToxicologicosPersonales;
use Illuminate\Http\Request;
use DB;


class HabitosToxicologicosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitosToxicologicosPersonales = habitosToxicologicosPersonales::get();
        echo json_encode($habitosToxicologicosPersonales);
      
    }


    public function show($id_paciente){

        $habito_toxicologico_personal = DB::table('habitos_toxicologicos_personales')
        ->where('id_paciente', $id_paciente)
        ->first();
        echo json_encode($habito_toxicologico_personal);      
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $habito_toxicologico_personal = new habitosToxicologicosPersonales();
       $habito_toxicologico_personal->alcohol = $request->input(['alcohol']);
       $habito_toxicologico_personal->observacion_alcohol = $request->input(['observacion_alcohol']);
       $habito_toxicologico_personal->tabaquismo = $request->input(['tabaquismo']);
       $habito_toxicologico_personal->observacion_tabaquismo = $request->input(['observacion_tabaquismo']);
       $habito_toxicologico_personal->marihuana = $request->input(['marihuana']);
       $habito_toxicologico_personal->observacion_marihuana = $request->input(['observacion_marihuana']);
       $habito_toxicologico_personal->cocaina = $request->input(['cocaina']);
       $habito_toxicologico_personal->observacion_cocaina = $request->input(['observacion_cocaina']);
       $habito_toxicologico_personal->otros = $request->input(['otros']);
       $habito_toxicologico_personal->observacion_otros = $request->input(['observacion_otros']);
       $habito_toxicologico_personal->id_paciente = $request->input(['id_paciente']);

       $habito_toxicologico_personal->save();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\habitosToxicologicosPersonales  $habitosToxicologicosPersonales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_paciente)
    {
        $alcohol = $request->input(['alcohol']);
        $observacion_alcohol = $request->input(['observacion_alcohol']);
        $tabaquismo = $request->input(['tabaquismo']);
        $observacion_tabaquismo = $request->input(['observacion_tabaquismo']);
        $marihuana = $request->input(['marihuana']);
        $observacion_marihuana = $request->input(['observacion_marihuana']);
        $cocaina = $request->input(['cocaina']);
        $observacion_cocaina = $request->input(['observacion_cocaina']);
        $otros = $request->input(['otros']);
        $observacion_otros = $request->input(['observacion_otros']);

        DB::table('habitos_toxicologicos_personales')
            ->where('id_paciente', $id_paciente)
            ->update([

                'alcohol'=> $alcohol,
                'observacion_alcohol' => $observacion_alcohol,
                'tabaquismo' => $tabaquismo, 
                'observacion_tabaquismo' => $observacion_tabaquismo,
                'marihuana' => $marihuana,                           
                'observacion_marihuana' => $observacion_marihuana,
                'cocaina' => $cocaina,
                'observacion_cocaina' => $observacion_cocaina, 
                'otros' => $otros,
                'observacion_otros' => $observacion_otros,
                

            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\habitosToxicologicosPersonales  $habitosToxicologicosPersonales
     * @return \Illuminate\Http\Response
     */
    public function destroy(habitosToxicologicosPersonales $habitosToxicologicosPersonales)
    {
        DB::table('pacientes_habitos_toxicologicos')->where('id_enfermedad', $pacientesAntecedentesFamiliares)->delete(); 
    }
}
