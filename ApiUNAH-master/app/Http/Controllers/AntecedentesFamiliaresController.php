<?php

namespace App\Http\Controllers;

use App\antecedentesFamiliares;
use Illuminate\Http\Request;
use DB;


class AntecedentesFamiliaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $antecendentes_familiares = antecedentesFamiliares::get();
        echo json_encode($antecendentes_familiares);
    }


    public function show($id_paciente){
        $antecedente_familiar = DB::table('antecedentes_familiares')->where('id_paciente', $id_paciente)->first();

        echo json_encode($antecedente_familiar);
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
            'desnutricion' => 'required',
            'enfermedades_mentales' => 'required',
            'convulsiones' => 'required',
            'alcoholismo_sustancias_psicoactivas' => 'required',
            'alergias' => 'required',
            'cancer' => 'required',
            'hipertension_arterial' => 'required',
        ],[
            '.required' => 'El campo es obligatorio'

        ]);
        
        $antecedente_familiar = new antecedentesFamiliares();
        $antecedente_familiar->diabetes = $datos_validados['diabetes'];
        $antecedente_familiar->parentesco_diabetes = $request->input(['parentesco_diabetes']);
        $antecedente_familiar->tb_pulmonar = $datos_validados['tb_pulmonar'];
        $antecedente_familiar->parentesco_tb_pulmonar = $request->input(['parentesco_tb_pulmonar']);
        $antecedente_familiar->desnutricion = $datos_validados['desnutricion'];
        $antecedente_familiar->parentesco_desnutricion = $request->input(['parentesco_desnutricion']);
        $antecedente_familiar->tipo_desnutricion = $request->input(['tipo_desnutricion']);
        $antecedente_familiar->enfermedades_mentales = $datos_validados['enfermedades_mentales'];
        $antecedente_familiar->parentesco_enfermedades_mentales = $request->input(['parentesco_enfermedades_mentales']);
        $antecedente_familiar->tipo_enfermedad_mental = $request->input(['tipo_enfermedad_mental']);
        $antecedente_familiar->convulsiones = $datos_validados['convulsiones'];
        $antecedente_familiar->parentesco_convulsiones = $request->input(['parentesco_convulsiones']);
        $antecedente_familiar->alcoholismo_sustancias_psicoactivas = $datos_validados['alcoholismo_sustancias_psicoactivas'];
        $antecedente_familiar->parentesco_alcoholismo_sustancias_psicoactivas = $request->input(['parentesco_alcoholismo_sustancias_psicoactivas']);
        $antecedente_familiar->alergias = $datos_validados['alergias'];
        $antecedente_familiar->parentesco_alergias = $request->input(['parentesco_alergias']);
        $antecedente_familiar->tipo_alergia = $request->input(['tipo_alergia']);
        $antecedente_familiar->cancer = $datos_validados['cancer'];
        $antecedente_familiar->parentesco_cancer = $request->input(['parentesco_cancer']);
        $antecedente_familiar->tipo_cancer = $request->input(['tipo_cancer']);
        $antecedente_familiar->hipertension_arterial = $datos_validados['hipertension_arterial'];
        $antecedente_familiar->parentesco_hipertension_arterial = $request->input(['parentesco_hipertension_arterial']);        
        $antecedente_familiar->otros = $request->input(['otros']);
        $antecedente_familiar->parentesco_otros = $request->input(['parentesco_otros']);
        $antecedente_familiar->id_paciente = $request->input(['id_paciente']);
        $antecedente_familiar->save();



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\antecedentesFamiliares  $antecedentesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_paciente)
    {

        $diabetes = $request->input(['diabetes']);
        $parentesco_diabetes = $request->input(['parentesco_diabetes']);
        $tb_pulmonar = $request->input(['tb_pulmonar']);
        $parentesco_tb_pulmonar = $request->input(['parentesco_tb_pulmonar']);
        $desnutricion = $request->input(['desnutricion']);
        $parentesco_desnutricion = $request->input(['parentesco_desnutricion']);
        $tipo_desnutricion = $request->input(['tipo_desnutricion']);
        $enfermedades_mentales = $request->input(['enfermedades_mentales']);
        $parentesco_enfermedades_mentales = $request->input(['parentesco_enfermedades_mentales']);
        $tipo_enfermedad_mental = $request->input(['tipo_enfermedad_mental']);
        $convulsiones = $request->input(['convulsiones']);
        $parentesco_convulsiones = $request->input(['parentesco_convulsiones']);
        $alcoholismo_sustancias_psicoactivas = $request->input(['alcoholismo_sustancias_psicoactivas']);
        $parentesco_alcoholismo_sustancias_psicoactivas = $request->input(['parentesco_alcoholismo_sustancias_psicoactivas']);
        $alergias = $request->input(['alergias']);
        $parentesco_alergias = $request->input(['parentesco_alergias']);
        $tipo_alergia = $request->input(['tipo_alergia']);
        $cancer = $request->input(['cancer']);
        $parentesco_cancer = $request->input(['parentesco_cancer']);
        $tipo_cancer = $request->input(['tipo_cancer']);
        $hipertension_arterial = $request->input(['hipertension_arterial']);
        $parentesco_hipertension_arterial = $request->input(['parentesco_hipertension_arterial']);        
        $otros = $request->input(['otros']);
        $parentesco_otros = $request->input(['parentesco_otros']);

            

            DB::table('antecedentes_familiares')
            ->where('id_paciente', $id_paciente)
            ->update([

                'diabetes'=> $diabetes,
                'parentesco_diabetes' => $parentesco_diabetes,
                'tb_pulmonar' => $tb_pulmonar, 
                'parentesco_tb_pulmonar' => $parentesco_tb_pulmonar,
                'desnutricion' => $desnutricion,                           
                'parentesco_desnutricion' => $parentesco_desnutricion,
                'tipo_desnutricion' => $tipo_desnutricion,
                'enfermedades_mentales' => $enfermedades_mentales, 
                'parentesco_enfermedades_mentales' => $parentesco_enfermedades_mentales,
                'tipo_enfermedad_mental' => $tipo_enfermedad_mental,
                'convulsiones' => $convulsiones,
                'parentesco_convulsiones' => $parentesco_convulsiones,
                'alcoholismo_sustancias_psicoactivas' => $alcoholismo_sustancias_psicoactivas,
                'parentesco_alcoholismo_sustancias_psicoactivas' => $parentesco_alcoholismo_sustancias_psicoactivas,
                'alergias' => $alergias,
                'parentesco_alergias' => $parentesco_alergias,
                'tipo_alergia' => $tipo_alergia,
                'cancer' => $cancer,
                'parentesco_cancer' => $parentesco_cancer,
                'tipo_cancer' => $tipo_cancer,
                'hipertension_arterial' => $hipertension_arterial,
                'parentesco_hipertension_arterial' => $parentesco_hipertension_arterial,
                'otros' => $otros,
                'parentesco_otros' => $parentesco_otros,


            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\antecedentesFamiliares  $antecedentesFamiliares
     * @return \Illuminate\Http\Response
     */
    public function destroy(antecedentesFamiliares $antecedentesFamiliares)
    {

    }
}
