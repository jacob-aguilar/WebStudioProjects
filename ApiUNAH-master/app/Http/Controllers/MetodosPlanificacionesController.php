<?php

namespace App\Http\Controllers;

use App\metodosPlanificaciones;
use Illuminate\Http\Request;

class MetodosPlanificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodos_planificaciones = metodosPlanificaciones::get();

        echo json_encode($metodos_planificaciones);
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
     * @param  \App\metodosPlanificaciones  $metodosPlanificaciones
     * @return \Illuminate\Http\Response
     */
    public function show(metodosPlanificaciones $metodosPlanificaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\metodosPlanificaciones  $metodosPlanificaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(metodosPlanificaciones $metodosPlanificaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\metodosPlanificaciones  $metodosPlanificaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, metodosPlanificaciones $metodosPlanificaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\metodosPlanificaciones  $metodosPlanificaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(metodosPlanificaciones $metodosPlanificaciones)
    {
        //
    }
}
