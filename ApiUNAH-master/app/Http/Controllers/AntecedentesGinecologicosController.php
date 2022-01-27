<?php

namespace App\Http\Controllers;

use App\antecedentesGinecologicos;
use Illuminate\Http\Request;
use DB;


class AntecedentesGinecologicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antecedentes_ginecologicos = antecedentesGinecologicos::get();
        return response()->json($antecedentes_ginecologicos);
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
            'edad_inicio_menstruacion' => ['required', 'max:18' , 'min:6', 'integer'],
            'fum' => ['required'],
            'citologia' => ['required'],
            'resultado_citologia' => ['nullable','max:150','min:4'],
            'duracion_ciclo_menstrual' => ['nullable','max:60','min:4'],
            'periocidad_ciclo_menstrual' => ['required'],
            'caracteristicas_ciclo_menstrual' => ['required']
        ]);
        $antecedente_ginecologico = new antecedentesGinecologicos();

        $antecedente_ginecologico->edad_inicio_menstruacion = $datos_validados['edad_inicio_menstruacion'];
        $antecedente_ginecologico->fum = $datos_validados['fum'];
        $antecedente_ginecologico->citologia = $datos_validados['citologia'];
        $antecedente_ginecologico->fecha_citologia = $request->input(['fecha_citologia']);
        $antecedente_ginecologico->resultado_citologia = $datos_validados['resultado_citologia'];
        $antecedente_ginecologico->duracion_ciclo_menstrual = $datos_validados['duracion_ciclo_menstrual'];
        $antecedente_ginecologico->periocidad_ciclo_menstrual = $datos_validados['periocidad_ciclo_menstrual'];
        $antecedente_ginecologico->caracteristicas_ciclo_menstrual = $datos_validados['caracteristicas_ciclo_menstrual'];
        $antecedente_ginecologico->id_paciente = $request->input(['id_paciente']);

        $antecedente_ginecologico->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\antecedentesGinecologicos  $antecedentesGinecologicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_ante_gine)
    {
        $edad_inicio_menstruacion = $request->input(['edad_inicio_menstruacion']);
        $fum = $request->input(['fum']);
        $citologia = $request->input(['citologia']);
        $fecha_citologia = $request->input(['fecha_citologia']);
        $resultado_citologia = $request->input(['resultado_citologia']);
        $duracion_ciclo_menstrual = $request->input(['duracion_ciclo_menstrual']);
        $periocidad_ciclo_menstrual = $request->input(['periocidad_ciclo_menstrual']);
        $caracteristicas_ciclo_menstrual = $request->input(['caracteristicas_ciclo_menstrual']);

        DB::table('antecedentes_ginecologicos')
        ->where('id_antecedente__ginecologico', $id_ante_gine)
        ->update([

            'edad_inicio_menstruacion'=> $edad_inicio_menstruacion,
            'fum' => $fum,
            'citologia' => $citologia, 
            'fecha_citologia' => $fecha_citologia,
            'resultado_citologia' => $resultado_citologia,
            'duracion_ciclo_menstrual' => $duracion_ciclo_menstrual,
            'periocidad_ciclo_menstrual' => $periocidad_ciclo_menstrual,
            'caracteristicas_ciclo_menstrual' => $caracteristicas_ciclo_menstrual,
            

        ]);

    }

    public function show($id_paciente){

        $antecedente_ginecologico = DB::table('antecedentes_ginecologicos')
       ->where('id_paciente', $id_paciente)
        ->select(
            'id_antecedente__ginecologico','edad_inicio_menstruacion', 'fum','citologia','fecha_citologia',
            'resultado_citologia','duracion_ciclo_menstrual', 'periocidad_ciclo_menstrual','caracteristicas_ciclo_menstrual',
            'id_paciente'
         ) 
         
        ->first();


        echo json_encode($antecedente_ginecologico);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\antecedentesGinecologicos  $antecedentesGinecologicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(antecedentesGinecologicos $antecedentesGinecologicos)
    {
        //
    }
}
