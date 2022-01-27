<?php

namespace App\Http\Controllers;

use App\estadosCiviles;
use Illuminate\Http\Request;

class EstadosCivilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados_civiles = estadosCiviles::get();

        echo json_encode($estados_civiles);
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
     * @param  \App\estadosCiviles  $estadosCiviles
     * @return \Illuminate\Http\Response
     */
    public function show(estadosCiviles $estadosCiviles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\estadosCiviles  $estadosCiviles
     * @return \Illuminate\Http\Response
     */
    public function edit(estadosCiviles $estadosCiviles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\estadosCiviles  $estadosCiviles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estadosCiviles $estadosCiviles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\estadosCiviles  $estadosCiviles
     * @return \Illuminate\Http\Response
     */
    public function destroy(estadosCiviles $estadosCiviles)
    {
        //
    }
}
