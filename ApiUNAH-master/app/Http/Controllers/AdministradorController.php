<?php

namespace App\Http\Controllers;

use App\Administrador;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $login_admin = Administrador::get();
        return response()->json($login_admin);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $administrador = new Administrador();
        $administrador->usuario = $request->input(['usuario']);
        $administrador->nombre_completo = $request->input(['nombre_completo']);
        $administrador->identidad = $request->input(['identidad']);
        $administrador->save();

        DB::table('logins')->insert([
            'cuenta' => $administrador->usuario,
            'password' => bcrypt($request->input(['password'])),
            'id_rol' => 2,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrador  $loginAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $loginAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador  $loginAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $loginAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador  $loginAdmin_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_administrador)
    {

        $administrador = Administrador::find($id_administrador);

        DB::table('logins')
            ->where('cuenta', $administrador->usuario)
            ->update(['cuenta' => $request->usuario]);

        $administrador->usuario = $request->input(['usuario']);
        $administrador->nombre_completo= $request->input(['nombre_completo']);
        $administrador->identidad = $request->input(['identidad']);
        $administrador->save();  

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador  $loginAdmin_id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_administrador)
    
    {
        if($id_administrador != 1 ){

            $administrador = Administrador::find($id_administrador);

            DB::table('logins')->where([

                ['cuenta', $administrador->usuario],
                ['id_rol', 2],

            ])->delete();

            //elimino al admnistrador de la tabla login para que ya no tengo acceso
            // DB::table('logins')->where('cuenta', 'id_rol', [$administrador->usuario, $administrador->id_rol])->delete();

            //elimino al medico de la tabla administradores
            DB::table('administradores')->where('id_administrador', $administrador->id_administrador)->delete();

            
        }
        
    }


    public function obtenerColumnaUsuarioAdmin($usuario){

        $admin = DB::table('administradores')->select('usuario')
        ->where('usuario', $usuario)
        ->first();
        
        echo json_encode($admin);

    }
    public function obtenerColumnaIdentidadAdmin(){

        $admin = DB::table('administradores')->select('identidad')
        
        ->get();
        
        echo json_encode($admin);

    }

    public function obtenerAdministrador($id){
        

        $administrador = DB::table('administradores')->where('id_administrador', $id)->first();

        echo json_encode($administrador);
    
    
        
    }
}
