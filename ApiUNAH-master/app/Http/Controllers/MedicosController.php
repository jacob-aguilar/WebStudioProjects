<?php

namespace App\Http\Controllers;

use App\Medico;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = DB::table('medicos')
        ->join('especialidades', 'medicos.especialidad', '=', 'especialidades.id_especialidad')
        
       ->select(
          'id_medico','usuario','nombre',
           'numero_identidad', 'especialidades.especialidad'
           
           ) 
        ->get();

       // $medicos = Medicos::get();
        echo json_encode($medicos);
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

        // $contra = $request->input('contraseniaM');
        // $hashed = Hash::make($contra);

        $medico = new Medico();
        $medico->usuario = $request->input(['usuario']);
        $medico->nombre = $request->input(['nombre']);
        $medico->numero_identidad = $request->input(['numero_identidad']);
        $medico->especialidad = $request->input(['especialidad']);
        $medico->permisos = $request->permisos;
        $medico->save();

        DB::table('logins')->insert([
            'cuenta' => $medico->usuario,
            'password' => bcrypt($request->input(['password'])),
            'id_rol' => 3
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicos  $medicos
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $medicos = DB::table('medicos')
        ->join('especialidades', 'medicos.especialidad', '=', 'especialidades.id_especialidad')
        ->where('id_medico', $id)
        ->select(
            'id_medico','usuario','nombre',
             'numero_identidad', 'especialidades.especialidad'
           
            ) 
        ->first();

        echo json_encode($medicos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicos  $medicos
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicos $medicos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medicos_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_medico)
    {
        $medico = Medico::find($id_medico);    

        DB::table('logins')
            ->where('cuenta', $medico->usuario)
            ->update([
                'cuenta' => $request->usuario,
            ]);
            
        $medico->usuario = $request->input(['usuario']);
        $medico->nombre = $request->input(['nombre']);
        $medico->numero_identidad = $request->input(['numero_identidad']);
        $medico->especialidad = $request->input(['especialidad']);
        $medico->permisos = $request->permisos;
        $medico->save();

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medicos_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_medico)
    {

    
        $medico = Medico::find($id_medico);

        //elimino al admnistrador de la tabla login para que ya no tengo acceso
        DB::table('logins')->where([

            ['cuenta', $medico->usuario],
            ['id_rol', 3],

        ])->delete();


        //elimino al medico de la tabla administradores
        DB::table('medicos')->where('id_medico', $medico->id_medico)->delete();

            
    
        // //elimino al medico de la tabla medicos
        // DB::table('medicos')->where('id_medico', $id_medico)->delete();

        // //elimino al medico de la tabla login para que ya no tengo acceso
        // DB::table('logins')->where('id_medico', $id_medico)->delete();
    }

    public function obtenerMedico($id){

        $medico = DB::table('medicos')->where('id_medico', $id)->first();

        echo json_encode($medico);


    }

    public function obtenerColumnaUsuarioMedicos($usuario){

        $medicos = DB::table('medicos')->select('usuario')
        ->where('usuario', $usuario)
        ->first();
        
        echo json_encode($medicos);

    }
    public function obtenerColumnaIdentidadMedico()
    {
        $medicos = DB::table('medicos')
        ->join('especialidades', 'medicos.especialidad', '=', 'especialidades.id_especialidad')
        
       ->select(
          'id_medico','usuario','nombre',
           'numero_identidad', 'especialidades.especialidad'
           
           ) 
        ->get();

       // $medicos = Medicos::get();
        echo json_encode($medicos);
    }
}
