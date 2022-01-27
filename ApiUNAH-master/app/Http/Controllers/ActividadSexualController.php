<?php

namespace App\Http\Controllers;

use App\ActividadSexual;
use Illuminate\Http\Request;
use DB;


class ActividadSexualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $actividades_sexuales = DB::table('actividad_sexuals')
        ->join('practicas_sexuales', 'actividad_sexuals.practicas_sexuales_riesgo', '=', 'practicas_sexuales.id_practica_sexual')
        
        ->select(
            'id_actividad_sexual','actividad_sexual', 'edad_inicio_sexual','numero_parejas_sexuales',
            'practicas_sexuales.practicas_sexuales_riesgo', 'id_paciente'
           
            )
        ->get();

        return response()->json($actividades_sexuales);
    }

   // public function show($id_actividad_sexual)
    //{
        //buscamos al paciente por id y mostramos solo el primer resultado para 
        //evitar problemas al momento de mandar a traer los datos en angular

       // $actividades_sexuales = DB::table('actividad_sexuals')
            
         //   ->where('id_actividad_sexual', $id_actividad_sexual)    
            
         //   ->first();

       // echo json_encode($actividades_sexuales);
   // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datos_validados = $request->validate([

            'actividad_sexual' => 'nullable',
            'edad_inicio_sexual' => ['nullable','max:99', 'min:1', 'integer'],
            'numero_parejas_sexuales' => ['nullable','max:1000', 'min:1', 'integer']

        ]);

        $actividad_sexual = new ActividadSexual();

        $actividad_sexual->actividad_sexual = $datos_validados['actividad_sexual'];
        $actividad_sexual->edad_inicio_sexual = $datos_validados['edad_inicio_sexual'];
        $actividad_sexual->numero_parejas_sexuales = $datos_validados['numero_parejas_sexuales'];
        $actividad_sexual->practicas_sexuales_riesgo = $request->input(['practicas_sexuales_riesgo']);
        $actividad_sexual->id_paciente = $request->input(['id_paciente']);

        $actividad_sexual->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActividadSexual  $actividadSexual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_actividad_sexual)
    {
        $datos_validados = $request->validate([

            'actividad_sexual' => 'nullable',
            'edad_inicio_sexual' => ['nullable','max:99', 'min:1', 'integer'],
            'numero_parejas_sexuales' => ['nullable','max:1000', 'min:1', 'integer']

        ]);

        $actividad_sexual = $datos_validados['actividad_sexual'];
        $edad_inicio_sexual = $datos_validados['edad_inicio_sexual'];
        $numero_parejas_sexuales = $datos_validados['numero_parejas_sexuales'];
        $practicas_sexuales_riesgo = $request->input(['practicas_sexuales_riesgo']);


        DB::table('actividad_sexuals')
        ->where('id_actividad_sexual', $id_actividad_sexual)
        ->update([

            'actividad_sexual'=> $actividad_sexual,
            'edad_inicio_sexual' => $edad_inicio_sexual,
            'numero_parejas_sexuales' => $numero_parejas_sexuales, 
            'practicas_sexuales_riesgo' => $practicas_sexuales_riesgo,
            

        ]);
    }

    public function show($id_paciente){

        $actividad_sexual = DB::table('actividad_sexuals')
        ->join('practicas_sexuales', 'actividad_sexuals.practicas_sexuales_riesgo', '=', 'practicas_sexuales.id_practica_sexual')
        ->where('id_paciente', $id_paciente)
        ->select(
            'id_actividad_sexual','actividad_sexual', 'edad_inicio_sexual','numero_parejas_sexuales',
            'practicas_sexuales.practicas_sexuales_riesgo', 'id_paciente'
           
            )
        ->first();

        echo json_encode($actividad_sexual);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActividadSexual  $actividadSexual
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_actividadSexual)
    {        
        DB::table('actividad_sexuals')->where('id_paciente', $id_actividadSexual)->delete(); 
    }
}
