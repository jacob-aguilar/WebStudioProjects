<?php

namespace App\Http\Controllers;

use App\Inventario;
use Illuminate\Http\Request;
use DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $inventarios = DB::table('inventarios')
            ->join('inventarios_presentaciones', 'inventarios.presentacion', '=', 'inventarios_presentaciones.id_inventario_presentacion')
            
            ->select(
                'id_inventario','unidad','nombre', 'descripcion','inventarios_presentaciones.presentacion',
                'observacion'
                )
                ->orderBy('unidad', 'DESC')
            ->get();


        //$inventarios = Inventario::get();
        echo json_encode($inventarios);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario = new Inventario(); 
        $inventario->unidad = $request->input('unidad');
        $inventario->nombre = $request->input('nombre');
        $inventario->descripcion = $request->input('descripcion');
        $inventario->presentacion = $request->input('presentacion');
        $inventario->observacion = $request->input('observacion');
        //$inventario->fecha_vencimiento = $request->input('fecha_vencimiento');
        $inventario->save();

        echo json_encode($inventario);
    }

    public function show($id_inventario)
    {
        //buscamos al paciente por id y mostramos solo el primer resultado para 
        //evitar problemas al momento de mandar a traer los datos en angular

        $inventario = DB::table('inventarios')
            ->join('inventarios_presentaciones', 'inventarios.presentacion', '=', 'inventarios_presentaciones.id_inventario_presentacion')
            ->where('id_inventario', $id_inventario)
            ->select(
                'id_inventario','unidad','nombre', 'descripcion','inventarios_presentaciones.presentacion',
               'observacion'
                )
            ->first();


        //$inventarios = Inventario::get();
        echo json_encode($inventario);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_inventario)
    {
        
       
        $unidad = $request->input('unidad');
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $presentacion = $request->input('presentacion');
        $observacion = $request->input('observacion');
        //$fecha_vencimiento = $request->input('fecha_vencimiento');
       
        

        DB::table('inventarios')
        ->where('id_inventario', $id_inventario)
        ->update([
            'unidad'=> $unidad,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'presentacion' => $presentacion,
            'observacion' => $observacion,            
            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy($inventario_id)
    {
        $inventario = Inventario::find($inventario_id);
        $inventario->delete();
        
    }
    public function obtenerMedicamentos()
    {
        $medicamentos = DB::select('SELECT id_inventario, nombre as medicamento, unidad as unidades FROM inventarios');
        echo json_encode($medicamentos);
    }    
    public function disminucion(Request $request)
    {
        $inventario = new Inventario();
        //$modificacion = DB::select('SELECT * FROM inventarios where id_inventario = ?',[$request->input('id')]);
        $modificacion = Inventario::where('id_inventario',$request->input('id'))->first();
        $modificacion->unidad = $modificacion->unidad - $request->input('cantidad');
        // $inventario->id_inventario = $request->input('id');
        // $inventario->unidad = $request->input('cantidad');
        // $inventario->save();    
        $inven = Inventario::where('id_inventario',$request->input('id'))->update(['unidad'=> $modificacion->unidad]);    
        //$modificacion->save();
    }
}
