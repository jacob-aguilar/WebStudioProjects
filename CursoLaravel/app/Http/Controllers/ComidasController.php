<?php

namespace App\Http\Controllers;

use App\Comida;
use Illuminate\Http\Request;

class ComidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comidas = Comida::all();
        return view("mostrarComidas")->with("comidas",$comidas);
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
        $comida = new Comida();
        $comida->nombre = $request->input("nombre");
        $comida->sabor = $request->input("sabor");
        $comida->precio = $request->input("precio");

        $comida->save();

        return back()->with(["exito"=>"Se agregó exitosamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            //Eliminamos las comidas
        Comida::destroy($request->input("id"));



        return back()->with(["exito"=>"Se eliminó correctamente"]);

    }

    public function buscarApi($busqueda){
        $comidas =
            Comida::where("nombre","like","%".$busqueda."%")
                ->orWhere("precio","like","%".$busqueda."%")
                ->get();

        return response()->json(["comidas"=>$comidas]);
    }


    public function buscar(Request $request){
        $busqueda = $request->input("busqueda");
        $comidas =
            Comida::where("nombre","like","%".$busqueda."%")
                ->orWhere("precio","like","%".$busqueda."%")
                ->get();

        return view("mostrarComidas")->with("comidas",$comidas);

    }
}
