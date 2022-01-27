<?php

namespace App\Http\Controllers;

use App\Enfermedades;
use database\funciones\insertarEnfermedad;
use DB;
use Illuminate\Http\Request;

// include 'database/funciones/insertarAntecedente';

class EnfermedadesController extends Controller
{


    protected $insertarAntecedente;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfermedades = Enfermedades::get();
        echo json_encode($enfermedades);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insertarEnfermedad = new insertarEnfermedad();
        $enfermedad = $request->input('enfermedad');
        $id_grupo_enfermedad = $request->input('id_grupo_enfermedad');

        $id_enfermedad = $insertarEnfermedad->ejecutar($enfermedad, $id_grupo_enfermedad);

        echo json_encode($id_enfermedad);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Antecedentes  $antecedentes
     * @return \Illuminate\Http\Response
     */
    public function show(Antecedentes $antecedentes)
    {
        
    }


    public function obtenerColumnaEnfermedad($id_grupo_enfermedad){

        $enfermedades = DB::table('enfermedades')->select('enfermedad')
        ->where('id_grupo_enfermedad', $id_grupo_enfermedad)
        ->get();
        
        echo json_encode($enfermedades);

    }


    // public function insertar(Request $request){

    //     $insertarAntecedente = new insertarAntecedente();
    //     $antecedente = $request->input('antecedente');
    //     $id_antecedente = $insertarAntecedente->ejecutar($antecedente);

    //     echo json_encode($id_antecedente);

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Antecedentes  $antecedentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_enfermedad)
    {

        $enfermedad = $request->input(['enfermedad']);

        DB::table('enfermedades')
        ->where('id_enfermedad', $id_enfermedad)
        ->update([
            'enfermedad'=> $enfermedad,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Antecedentes  $antecedentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antecedentes $antecedentes)
    {
        //
    }
}
