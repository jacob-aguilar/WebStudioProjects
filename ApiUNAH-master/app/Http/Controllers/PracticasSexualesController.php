<?php

namespace App\Http\Controllers;

use App\practicasSexuales;
use Illuminate\Http\Request;

class PracticasSexualesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practicas_sexuales = practicasSexuales::get();

        echo json_encode($practicas_sexuales);
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
     * @param  \App\practicasSexuales  $practicasSexuales
     * @return \Illuminate\Http\Response
     */
    public function show(practicasSexuales $practicasSexuales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\practicasSexuales  $practicasSexuales
     * @return \Illuminate\Http\Response
     */
    public function edit(practicasSexuales $practicasSexuales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\practicasSexuales  $practicasSexuales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, practicasSexuales $practicasSexuales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\practicasSexuales  $practicasSexuales
     * @return \Illuminate\Http\Response
     */
    public function destroy(practicasSexuales $practicasSexuales)
    {
        //
    }
}
