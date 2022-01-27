<?php

namespace App\Http\Controllers;

use App\antecedentes_personales;
use App\antecedentesPersonales;
use Illuminate\Http\Request;
use DB;


class AntecedentesPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $antecedentes_personales = antecedentesPersonales::get();
       return response()->json($antecedentes_personales);
    }


    public function show($id_paciente){

        $antecedente_personal = DB::table('antecedentes_personales')
                                ->where('id_paciente', $id_paciente)->first();

        return response()->json($antecedente_personal);
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

            'diabetes' => 'required',
            'tb_pulmonar' => 'required',
            'its' => 'required',
            'desnutricion' => 'required',
            'enfermedades_mentales' => 'required',
            'convulsiones' => 'required',
            'alergias' => 'required',
            'cancer' => 'required',
            'hospitalarias_quirurgicas' => 'required',
            'traumaticos' => 'required',

        ]);


        $antecedente_personales = new antecedentesPersonales();
        $antecedente_personales->diabetes = $datos_validados['diabetes'];
        $antecedente_personales->observacion_diabetes = $request->input(['observacion_diabetes']);
        $antecedente_personales->tb_pulmonar = $datos_validados['tb_pulmonar'];
        $antecedente_personales->observacion_tb_pulmonar = $request->input(['observacion_tb_pulmonar']);
        $antecedente_personales->its = $datos_validados['its'];
        $antecedente_personales->observacion_its = $request->input(['observacion_its']);
        $antecedente_personales->desnutricion = $datos_validados['desnutricion'];
        $antecedente_personales->observacion_desnutricion = $request->input(['observacion_desnutricion']);
        $antecedente_personales->tipo_desnutricion = $request->input(['tipo_desnutricion']);
        $antecedente_personales->enfermedades_mentales = $datos_validados['enfermedades_mentales'];
        $antecedente_personales->observacion_enfermedades_mentales = $request->input(['observacion_enfermedades_mentales']);
        $antecedente_personales->tipo_enfermedad_mental = $request->input(['tipo_enfermedad_mental']);
        $antecedente_personales->convulsiones = $datos_validados['convulsiones'];
        $antecedente_personales->observacion_convulsiones = $request->input(['observacion_convulsiones']);
        $antecedente_personales->alergias = $datos_validados['alergias'];
        $antecedente_personales->observacion_alergias = $request->input(['observacion_alergias']);
        $antecedente_personales->tipo_alergia = $request->input(['tipo_alergia']);
        $antecedente_personales->cancer = $datos_validados['cancer'];
        $antecedente_personales->observacion_cancer = $request->input(['observacion_cancer']);
        $antecedente_personales->tipo_cancer = $request->input(['tipo_cancer']);
        $antecedente_personales->hospitalarias_quirurgicas = $datos_validados['hospitalarias_quirurgicas'];
        $antecedente_personales->fecha_antecedente_hospitalario = $request->input(['fecha_antecedente_hospitalario']);
        $antecedente_personales->tratamiento = $request->input(['tratamiento']);
        $antecedente_personales->diagnostico = $request->input(['diagnostico']);
        $antecedente_personales->tiempo_hospitalizacion = $request->input(['tiempo_hospitalizacion']); 
        $antecedente_personales->traumaticos = $datos_validados['traumaticos'];
        $antecedente_personales->observacion_traumaticos = $request->input(['observacion_traumaticos']);
        $antecedente_personales->otros = $request->input(['otros']);
        $antecedente_personales->observacion_otros = $request->input(['observacion_otros']);
        $antecedente_personales->id_paciente = $request->input(['id_paciente']);

        $antecedente_personales->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\antecedentes_personales  $antecedentes_personales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_paciente)
    {

        $diabetes = $request->input(['diabetes']);
        $observacion_diabetes = $request->input(['observacion_diabetes']);
        $tb_pulmonar = $request->input(['tb_pulmonar']);
        $observacion_tb_pulmonar = $request->input(['observacion_tb_pulmonar']);
        $its = $request->input(['its']);
        $observacion_its = $request->input(['observacion_its']);
        $desnutricion = $request->input(['desnutricion']);
        $observacion_desnutricion = $request->input(['observacion_desnutricion']);
        $tipo_desnutricion = $request->input(['tipo_desnutricion']);
        $enfermedades_mentales = $request->input(['enfermedades_mentales']);
        $observacion_enfermedades_mentales = $request->input(['observacion_enfermedades_mentales']);
        $tipo_enfermedad_mental = $request->input(['tipo_enfermedad_mental']);
        $convulsiones = $request->input(['convulsiones']);
        $observacion_convulsiones = $request->input(['observacion_convulsiones']);
        $alergias = $request->input(['alergias']);
        $observacion_alergias = $request->input(['observacion_alergias']);
        $tipo_alergia = $request->input(['tipo_alergia']);
        $cancer = $request->input(['cancer']);
        $observacion_cancer = $request->input(['observacion_cancer']);
        $tipo_cancer = $request->input(['tipo_cancer']);
        $hospitalarias_quirurgicas = $request->input(['hospitalarias_quirurgicas']);
        $fecha_antecedente_hospitalario = $request->input(['fecha_antecedente_hospitalario']);
        $tratamiento = $request->input(['tratamiento']);
        $diagnostico = $request->input(['diagnostico']);
        $tiempo_hospitalizacion = $request->input(['tiempo_hospitalizacion']); 
        $traumaticos = $request->input(['traumaticos']);
        $observacion_traumaticos = $request->input(['observacion_traumaticos']);
        $otros = $request->input(['otros']);
        $observacion_otros = $request->input(['observacion_otros']);


        DB::table('antecedentes_personales')
            ->where('id_paciente', $id_paciente)
            ->update([

                'diabetes'=> $diabetes,
                'observacion_diabetes' => $observacion_diabetes,
                'tb_pulmonar' => $tb_pulmonar, 
                'observacion_tb_pulmonar' => $observacion_tb_pulmonar,
                'its' => $its,                           
                'observacion_its' => $observacion_its,
                'desnutricion' => $desnutricion,
                'observacion_desnutricion' => $observacion_desnutricion, 
                'tipo_desnutricion' => $tipo_desnutricion,
                'enfermedades_mentales' => $enfermedades_mentales,
                'observacion_enfermedades_mentales' => $observacion_enfermedades_mentales,
                'tipo_enfermedad_mental' => $tipo_enfermedad_mental,
                'convulsiones' => $convulsiones,
                'observacion_convulsiones' => $observacion_convulsiones,
                'alergias' => $alergias,
                'observacion_alergias' => $observacion_alergias,
                'tipo_alergia' => $tipo_alergia,
                'cancer' => $cancer,
                'observacion_cancer' => $observacion_cancer,
                'tipo_cancer' => $tipo_cancer,
                'hospitalarias_quirurgicas' => $hospitalarias_quirurgicas,
                'fecha_antecedente_hospitalario' => $fecha_antecedente_hospitalario,
                'tratamiento' => $tratamiento,
                'diagnostico' => $diagnostico,
                'tiempo_hospitalizacion' => $tiempo_hospitalizacion,
                'traumaticos' => $traumaticos,
                'observacion_traumaticos' => $observacion_traumaticos,
                'otros' => $otros,
                'observacion_otros' => $observacion_otros,


            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\antecedentes_personales  $antecedentes_personales
     * @return \Illuminate\Http\Response
     */
    public function destroy(antecedentes_personales $antecedentes_personales)
    {
        //
    }
}
