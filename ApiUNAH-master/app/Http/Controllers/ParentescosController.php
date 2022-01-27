<?php

namespace App\Http\Controllers;

use App\Parentescos;
use Illuminate\Http\Request;

class ParentescosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentescos = Parentescos::get();

        echo json_encode($parentescos);
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
     * @param  \App\Parentescos  $parentescos
     * @return \Illuminate\Http\Response
     */
    public function show(Parentescos $parentescos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parentescos  $parentescos
     * @return \Illuminate\Http\Response
     */
    public function edit(Parentescos $parentescos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parentescos  $parentescos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parentescos $parentescos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parentescos  $parentescos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parentescos $parentescos)
    {
        //
    }
}
