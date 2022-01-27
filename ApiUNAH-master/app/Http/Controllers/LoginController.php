<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterAuthRequest;
use  JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
include '../includes/login_unah.php';
use Mail;
use View;

class LoginController extends Controller

    
{

    public  $loginAfterSignUp = true;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $logins = Login::first();
        // echo json_encode($logins);

        // orderBy('id_login','desc')->take(1); 

        
        $logins = Login::all()->last();

        if($logins==null){
            $logins= new Login();
            $logins->cuenta='';
            $logins->nombre='';
            $logins->carrera='';
            $logins->centro='';
            $logins->numero_identidad='';
        }

        return  response()->json($logins);
    }

    public function ultimoIdLogin(){

        $si= DB::select('SELECT MAX(id_login) as ultimoId FROM logins');

        return response()->json($si);
        
        
    }

    public function show($id_paciente)
    {


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {
        
       
        
        
    }

    public function actualizarCuenta(Request $request){


            DB::table('logins')
            ->where('id_login', $request->id_login)
            ->update([
    
                
                'cuenta' => $request->cuenta,
                

                
            ]);
        
    }

    public function actualizarContrasena(Request $request){

        if($request->cuenta){

            if($request->input('password')!= null ){

                $nuevo_password = bcrypt($request->password);
    
                DB::table('logins')
                ->where([
                    ['cuenta', $request->cuenta],
                    // ['id_rol', $request->id_rol]

                ])->update([
                    'password' =>  $nuevo_password]);
            }

        }else{

            if($request->input('password')!= null ){

                $nuevo_password = bcrypt($request->password);
    
                DB::table('logins')
                ->where('id_login', $request->id_login)
                ->update(['password' =>  $nuevo_password]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }

    public  function  register(Request  $request) {


		$cuenta = $request->input('cuenta');
        $password = $request->input('password');
        
        $datos_login= new Login();
        
        $datos_login->cuenta = $cuenta;
        $datos_login->password = bcrypt($request->password);
        $datos_login->id_rol = 1;
        $datos_login->save();

        if ($this->loginAfterSignUp) {
            return  $this->login($request);
        }

        return  response()->json([
            'status' => 'ok',
            'data' => $datos_login
        ], 200);
        
	}

    public function ingresarFormulario(Request $request){

        $cuenta = $request->input('cuenta');
        $password = $request->input('password');

        $alumno = accesoAlumno($cuenta, $password);

        if(is_null($alumno)){

            return  response()->json(["codigoError" => 1, "msg"=> "numero de cuenta o contraseña incorrecta"]);

        }else{

            return  response()->json(["codigoError" => 2, 
                    "cuenta" => $alumno['cuenta'],
                    "nombre" => $alumno['nombre'],
                    "carrera" => $alumno['carrera'],
                    "centro" => $alumno['centro'],
                    "numero_identidad" => $alumno['numero_identidad'],
                    "imagen" => $alumno['imagen'],
                    // "correo" => $alumno['correo']

                    ]);
        }
                


    }
    public  function  login(Request  $request) {

		$input = $request->only('cuenta', 'password');
        $jwt_token = JWTAuth::attempt($input);
        
		if ($jwt_token = JWTAuth::attempt($input)) {

            return  response()->json([
                'codigoError' => 0,
                'msg' => 'Todo bien',
                'token' => $jwt_token
            ]);

			
        } else{

            return  response()->json([
				'status' => 'invalid_credentials',
				'message' => 'Correo o contraseña no válidos.',
            ], 401);
            


        }
        

		
	}

	public  function  logout(Request  $request) {
		$this->validate($request, [
			'token' => 'required'
		]);

		try {
			JWTAuth::invalidate($request->token);
			return  response()->json([
				'status' => 'ok',
				'message' => 'Cierre de sesión exitoso.'
			]);
		} catch (JWTException  $exception) {
			return  response()->json([
				'status' => 'unknown_error',
				'message' => 'Al usuario no se le pudo cerrar la sesión.'
			], 500);
		}
	}

    public  function  getAuthUser(Request $request) {

        $rol;

		$this->validate($request, [
			'token' => 'required'
		]);

        $user = JWTAuth::authenticate($request->token);

        if($user->id_rol == 1){

            $rol = 'Paciente'; 

            $usuarioRol = DB::table('pacientes')->where('numero_cuenta', $user->cuenta)->first();

            if(!isset($usuarioRol)){

                $usuarioRol = DB::table('pacientes')->where('numero_identidad', $user->cuenta)->first();

                return  response()->json([

                    'id' => $usuarioRol->id_paciente,
                    'usuario' => $usuarioRol->numero_cuenta,
                    'nombre' => $usuarioRol->nombre_completo,
                    'carrera' => $usuarioRol->carrera,
                    'numero_identidad' => $usuarioRol->numero_identidad,
                    'rol' => $rol,
        
                ]);


            }else{

                return  response()->json([

                    'id' => $usuarioRol->id_paciente,
                    'usuario' => $usuarioRol->numero_cuenta,
                    'nombre' => $usuarioRol->nombre_completo,
                    'carrera' => $usuarioRol->carrera,
                    'numero_identidad' => $usuarioRol->numero_identidad,
                    'rol' => $rol,
        
                ]);
            }

            

        } else if($user->id_rol == 2){

            $rol = 'Administrador';
            $usuarioRol = DB::table('administradores')->where('usuario', $user->cuenta)->first();

            return  response()->json([

                'id' => $usuarioRol->id_administrador,
                'usuario' => $usuarioRol->usuario,
                'nombre' => $usuarioRol->nombre_completo,
                'numero_identidad' => $usuarioRol->identidad,
                'rol' => $rol
    
            ]);



        } else{

            $rol = 'Medico';
            $usuarioRol = DB::table('medicos')->where('usuario', $user->cuenta)->first();

            return  response()->json([

                'id' => $usuarioRol->id_medico,
                'usuario' => $usuarioRol->usuario,
                'nombre' => $usuarioRol->nombre,
                'numero_identidad' => $usuarioRol->numero_identidad,
                'especialidad' => $usuarioRol->especialidad,
                'rol' => $rol,
                'permisos' => $usuarioRol->permisos,

    
            ]);

        }

        
        
        
		
    }

    
    
    // funcion que sirve para verificar si un usuario existe en la base de datos y si su contrasenia
    // es correcta, arrojando diferentes resultados segun sea el caso.
    public function obtenerUsuario(Request $request){

        $cuenta = $request->cuenta;
        $password = $request->password;

        //verifico si el numero de cuenta del usuario existe en la base de datos
        if($usuario = DB::table('logins')->where('cuenta', $cuenta)->first()){

            // si el usuario existe en la base de datos verifico si la contrasenia introducida es 
            // la correcta.
            if (Hash::check($password, $usuario->password)) {
    
                //si la contrasenia es la correcta se manda a loguear al usuario
                return $this->login($request);

    
            }else{

                //si la contrasenia no es correcta la correcta, se devuelvo el siguiente
                // mensaje en formato json.
                return  response()->json(["codigoError" => 1, "msg"=> "clave incorrecta"]);
            }
                

        // si el numero de cuenta del usuario no se encuentra en la base de datos entonces se devuelve como
        // resultado null.
        } else{

            return  response()->json(["codigoError"=> 2, "msg"=> "el usuario no existe"]);

        }


    }

    public function verificarClave(Request $request){

        $cuenta = $request->cuenta;
        $password = $request->password;


        $usuario = DB::table('logins')->where('cuenta', $cuenta)->first();

        if(Hash::check($password, $usuario->password)){

            return response()->json([
                'codigoError' => 0,
                'msg' => 'todo bien'
            ]);
        } else {

            return response()->json([
                'codigoError' => 1,
                'msg' => 'Clave incorrecta'
            ]);
        }




    }

    public function duplicarRegistro(Request $request){

        	
        $registro = Login::find($request->id_login);
        $nuevo_registro = $registro->replicate();
        $nuevo_registro->id_rol = $request->id_rol;
        $nuevo_registro->save();

    }
    
    public function obtenerIdLogin($cuenta){

        $id = DB::table('logins')
            ->select('id_login')
            ->where('cuenta', $cuenta)
            ->first();

           
        return response()->json($id);
    }

 


    public function obtenerUsuarioConCorreo($usuario){

        $usuario = DB::table('pacientes')
            ->select('id_paciente','nombre_completo','correo_electronico')
            ->where('correo_electronico', $usuario)
            ->first(); 
            return response()->json($usuario);       
            
    }

    // public function obtenerUsuarioConId($usuario){ 

    //     $prueba = DB::table('pacientes')
    //         ->select('id_paciente')
    //         ->where('correo_electronico', $usuario)
    //         ->first(); 
    //          return view('email')->with('prueba',$prueba);         
            
    // }



    // esto no lo ocupas
    public static  function mandarIdAView(  Request $request){ 
        $prueba = $request->input('id_paciente');     
    // View::share('identificador', $identificador);    
    //return view('email')->with('identificador', $identificador);
    return view('email')->with('prueba',$prueba);  
    }




     public function contact( Request $request){      

        $correo = $request->correo_electronico;     
        $id_paciente = $request->id_paciente;   
        $subject = "Recuperacion de contraseña";        
        $for = "$correo";

        $data = ['link' => 'http://localhost:4200/recuperarcontrasenia/'.$id_paciente];

        Mail::send('email', $data, function($msj) use($subject,$correo){
            $msj->from("melvindavidsevillamedina@gmail.com","Clinica UNAH-TEC");
            $msj->subject($subject);
            $msj->to($correo);            
        });        

    }


}
