<?php

namespace App\Http\Controllers;

use App\antecedentesObstetricos;
use Illuminate\Http\Request;
use DB;


class AntecedentesObstetricosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $antecedentes_obstetricos = antecedentesObstetricos::get();
        return response()->json($antecedentes_obstetricos);
    }

    public function show($id_paciente){

        $antecedente_obstetrico = DB::table('antecedentes_obstetricos')
        ->where('id_paciente', $id_paciente)
        ->select('id_antecedente_obstetrico','partos','abortos',
        'cesarias','hijos_vivos',
        'hijos_muertos','fecha_termino_ult_embarazo',
        'descripcion_termino_ult_embarazo','observaciones','id_paciente'          
         ) 
        ->first();

        echo json_encode($antecedente_obstetrico);
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
            
            'partos' => ['nullable', 'max:100', 'min:0', 'integer'],
            'abortos' => ['nullable', 'max:100', 'min:0' , 'integer'],
            'cesarias' => ['nullable', 'max:100', 'min:0', 'integer'],
            'hijos_vivos' => ['nullable', 'max:100', 'min:0', 'integer'],
            'hijos_muertos' => ['nullable', 'max:100', 'min:0', 'integer'],
            'observaciones' => ['nullable','max:150', 'min:4']
        ]);


        $antecedente_obstetrico = new antecedentesObstetricos();     
        

        $antecedente_obstetrico->partos = $datos_validados['partos'];
        $antecedente_obstetrico->abortos = $datos_validados['abortos'];
        $antecedente_obstetrico->cesarias = $datos_validados['cesarias'];
        $antecedente_obstetrico->hijos_vivos = $datos_validados['hijos_vivos'];
        $antecedente_obstetrico->hijos_muertos = $datos_validados['hijos_muertos'];
        $antecedente_obstetrico->fecha_termino_ult_embarazo = $request->input(['fecha_termino_ult_embarazo']);
        $antecedente_obstetrico->descripcion_termino_ult_embarazo = $request->input(['descripcion_termino_ult_embarazo']);
        $antecedente_obstetrico->observaciones = $datos_validados['observaciones'];
        $antecedente_obstetrico->id_paciente = $request->input(['id_paciente']);

        $antecedente_obstetrico->save();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\antecedentesObstetricos  $antecedentesObstetricos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_antecedente_obstetrico)
    {
        $partos = $request->input(['partos']);
        $abortos = $request->input(['abortos']);
        $cesarias = $request->input(['cesarias']);
        $hijos_vivos = $request->input(['hijos_vivos']);
        $hijos_muertos = $request->input(['hijos_muertos']);
        $fecha_termino_ult_embarazo = $request->input(['fecha_termino_ult_embarazo']);
        $descripcion_termino_ult_embarazo = $request->input(['descripcion_termino_ult_embarazo']);
        $observaciones = $request->input(['observaciones']);

        DB::table('antecedentes_obstetricos')
        ->where('id_antecedente_obstetrico', $id_antecedente_obstetrico)
        ->update([

            'partos'=> $partos,
            'abortos' => $abortos,
            'cesarias' => $cesarias, 
            'hijos_vivos' => $hijos_vivos,
            'hijos_muertos' => $hijos_muertos,
            'fecha_termino_ult_embarazo' => $fecha_termino_ult_embarazo,
            'descripcion_termino_ult_embarazo' => $descripcion_termino_ult_embarazo,
            'observaciones' => $observaciones,
            

        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\antecedentesObstetricos  $antecedentesObstetricos
     * @return \Illuminate\Http\Response
     */
    public function destroy(antecedentesObstetricos $antecedentesObstetricos)
    {
        //
    }
}
