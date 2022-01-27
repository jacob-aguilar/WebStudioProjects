<?php

namespace App\Http\Controllers;

use App\segurosMedicos;
use Illuminate\Http\Request;

class SegurosMedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguros_Medicos = segurosMedicos::get();

        echo json_encode($seguros_Medicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\segurosMedicos  $segurosMedicos
     * @return \Illuminate\Http\Response
     */
    public function show(segurosMedicos $segurosMedicos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\segurosMedicos  $segurosMedicos
     * @return \Illuminate\Http\Response
     */
    public function edit(segurosMedicos $segurosMedicos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\segurosMedicos  $segurosMedicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, segurosMedicos $segurosMedicos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\segurosMedicos  $segurosMedicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(segurosMedicos $segurosMedicos)
    {
        //
    }
}
