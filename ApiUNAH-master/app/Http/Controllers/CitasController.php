<?php

namespace App\Http\Controllers;

use App\Citas;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $citas = Citas::get();

        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('id_cita', 'pacientes.nombre_completo as paciente', 'fecha','hora')
        ->get();

        return response()->json($citas);

    
    }

    public function citasHoy()
    {
        // $citas = Citas::get();
        $actual = Carbon::now();
        $hoy = $actual->format('y-m-d');

        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('id_cita', 'pacientes.nombre_completo as paciente', 'fecha','hora')
        ->where('fecha', $hoy)
        ->get();

        return response()->json($citas);

    
    }


    public function citasVigentes($id_paciente)
    {
        // $ultimasCitas= DB::table('citas')->select('fecha')
        // ->where('id_paciente', $id_paciente)->orderBy('id_cita', 'desc')->limit(2)->get();
        // // $ultimaFecha = DB::select('SELECT MAX(fecha) as fecha FROM citas where id_paciente = ?', [$id_paciente]);


        $actual = Carbon::now();
        $hoyFecha = $actual->format('y-m-d');
        $hoyHora = $actual->format('h:m:s');


        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('id_cita', 'pacientes.nombre_completo as paciente', 'fecha','hora')
        ->where(
            
            [   
                ['citas.id_paciente', $id_paciente],
                ['fecha','>=', $hoyFecha],
                // ['fecha', '>', $ultimasCitas[1]->fecha]
            ]
        )
        ->get();

        return response()->json($citas);

    
    }
    //metodo que devuelve las fechas de las citas
    public function citasFechas($id_paciente)
    {
        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('fecha')
        ->where('citas.id_paciente', $id_paciente)
        ->get();

        return response()->json($citas);

    
    }
    public function citasporFecha($fecha)
    {
        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('pacientes.nombre_completo as paciente','hora')
        ->where('citas.fecha', $fecha)
        ->get();

        return response()->json($citas);

    
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
        $datos_validados = $request->validate([
            'fecha' => ['required', 'date'],
            'hora' => ['required'],
            // 'hora' => ['required', 'date_format:H:i'],
            'id_paciente' => ['required'],            
        ]);

        $cita = new Citas();

        $cita->fecha = $datos_validados['fecha'];
        $cita->hora = $datos_validados['hora'];
        $cita->id_paciente = $datos_validados['id_paciente'];

        $cita->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function show($id_paciente)
    {
        $citas = DB::table('citas')
        ->join('pacientes', 'pacientes.id_paciente' , '=' , 'citas.id_paciente')
        ->select('id_cita', 'pacientes.nombre_completo as paciente', 'fecha','hora')
        ->where('citas.id_paciente', $id_paciente)
        ->get();

        return response()->json($citas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citas $citas)
    {
        //
    }
}
