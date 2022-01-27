<?php

namespace App\Http\Controllers;

use App\planificacionesFamiliares;
use Illuminate\Http\Request;
use DB;


class PlanificacionesFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $planificaciones_familiares = DB::table('planificaciones_familiares')
        ->join('metodos_planificaciones', 'planificaciones_familiares.metodo_planificacion', '=', 'metodos_planificaciones.id_metodo_planificacion')
        
        ->select(
            'id_planificacion_familiar','planificacion_familiar', 'metodos_planificaciones.metodo_planificacion',
            'observacion_planificacion', 'id_paciente'
           
            )
        ->get();

        return response()->json($planificaciones_familiares);
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
            'planificacion_familiar' => 'required',
            'metodo_planificacion' => 'nullable',
            'observacion_planificacion' => 'max:150|min:4|nullable'
        ]);

        $planificacion_familiar = new planificacionesFamiliares();

        $planificacion_familiar->planificacion_familiar = $datos_validados['planificacion_familiar'];
        $planificacion_familiar->metodo_planificacion = $datos_validados['metodo_planificacion'];
        $planificacion_familiar->observacion_planificacion = $datos_validados['observacion_planificacion'];
        $planificacion_familiar->id_paciente = $request->input(['id_paciente']);

        $planificacion_familiar->save();

    }

    public function show($id_paciente){

        $planificacion_familiar = DB::table('planificaciones_familiares')
        ->join('metodos_planificaciones', 'planificaciones_familiares.metodo_planificacion', '=', 'metodos_planificaciones.id_metodo_planificacion')
        ->where('id_paciente', $id_paciente)
        ->select(
            'id_planificacion_familiar','planificacion_familiar', 'metodos_planificaciones.metodo_planificacion',
            'observacion_planificacion', 'id_paciente'
           
            )
        ->first();

        echo json_encode($planificacion_familiar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\planificacionesFamiliares  $planificacionesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_paciente)
    {

        $planificacion_familiar = $request->input(['planificacion_familiar']);
        $metodo_planificacion = $request->input(['metodo_planificacion']);
        $observacion_planificacion = $request->input(['observacion_planificacion']);


        DB::table('planificaciones_familiares')
            ->where('id_planificacion_familiar', $id_paciente)
            ->update([

                'planificacion_familiar'=> $planificacion_familiar,
                'metodo_planificacion' => $metodo_planificacion,
                'observacion_planificacion' => $observacion_planificacion,

            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\planificacionesFamiliares  $planificacionesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_paciente)
    {
        DB::table('planificaciones_familiares')->where('id_paciente', $id_paciente)->delete(); 
    }
}
