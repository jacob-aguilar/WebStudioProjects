<?php

namespace App\Http\Controllers;

use App\Paciente;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use Illuminate\Support\Facades\Mail;


class PacienteController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $pacientes = DB::table('pacientes')
            ->join('estados_civiles', 'pacientes.estado_civil', '=', 'estados_civiles.id_estado_civil')
            ->join('seguros_medicos', 'pacientes.seguro_medico', '=', 'seguros_medicos.id_seguro_medico')
            ->join('categorias', 'pacientes.categoria', '=', 'categorias.id_categorias')
            ->select(
                'pacientes.id_paciente','nombre_completo', 'correo_electronico','numero_cuenta','numero_identidad',
                'imagen', 'direccion', 'carrera', 'lugar_procedencia',
                'fecha_nacimiento', 'sexo', 'estados_civiles.estado_civil', 
                'seguros_medicos.seguro_medico', 'categorias.categoria','prosene',DB::raw("DATEDIFF(current_date, fecha_nacimiento)/365 as edad")
                )
            ->get();

        return response()->json($pacientes);


    }


    public function show($id_paciente)
    {
        //buscamos al paciente por id y mostramos solo el primer resultado para 
        //evitar problemas al momento de mandar a traer los datos en angular

        $paciente = DB::table('pacientes')
            ->join('estados_civiles', 'pacientes.estado_civil', '=', 'estados_civiles.id_estado_civil')
            ->join('seguros_medicos', 'pacientes.seguro_medico', '=', 'seguros_medicos.id_seguro_medico')
            ->join('categorias', 'pacientes.categoria', '=', 'categorias.id_categorias')
            ->join('telefonos_pacientes', 'pacientes.id_paciente', '=' ,'telefonos_pacientes.id_paciente')
            ->where('pacientes.id_paciente', $id_paciente)
            ->select(
                'pacientes.id_paciente','nombre_completo', 'correo_electronico','numero_cuenta','numero_identidad',
                'imagen', 'direccion', 'carrera', 'lugar_procedencia',
                'fecha_nacimiento', 'sexo', 'estados_civiles.estado_civil', 'telefonos_pacientes.telefono',
                'seguros_medicos.seguro_medico', 'categorias.categoria',
                'peso', 'talla', 'imc', 'temperatura', 'presion','pulso','prosene'
                )
                
            ->first();

        return response()->json($paciente);

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

            'nombre_completo' => ['required', 'regex:/^[a-zA-zñÑáéíóúÁÉÍÓÚ\s]{0,100}$/'],
            'correo_electronico' => 'required',
            'numero_cuenta' => ['nullable','regex:/^[2][0-9]{10}$/', 'unique:pacientes'],
            'numero_identidad' => ['required', 'regex: /^\d{4}\d{4}\d{5}$/ ', 'unique:pacientes'],
            'imagen'=>'nullable',
            'direccion'=> ['required','min:20', 'max:50'],
            'carrera' => ['nullable'],
            'lugar_procedencia' => ['required' , 'regex:/^[a-zA-zñÑáéíóúÁÉÍÓÚ\s]{3,20}$/'],
            'fecha_nacimiento' => ['required' , 'date'],
            'sexo' => 'required',
            'estado_civil' => ['required', 'integer'],
            'seguro_medico' => ['required' , 'integer'],
            'categoria' => ['required', 'integer'],
        ]);



        $paciente = new Paciente();

        $paciente->nombre_completo = $datos_validados['nombre_completo'];
        $paciente->correo_electronico = $datos_validados['correo_electronico'];
        $paciente->numero_cuenta = $datos_validados['numero_cuenta'];
        $paciente->numero_identidad = $datos_validados['numero_identidad'];
        $paciente->imagen = $datos_validados['imagen']; 
        $paciente->direccion = $datos_validados['direccion'];
        $paciente->carrera = $datos_validados['carrera'];
        $paciente->lugar_procedencia = $datos_validados['lugar_procedencia'];
        $paciente->fecha_nacimiento = $datos_validados['fecha_nacimiento'];
        $paciente->sexo = $datos_validados['sexo'];
        $paciente->estado_civil = $datos_validados['estado_civil'];
        $paciente->seguro_medico = $datos_validados['seguro_medico'];
        $paciente->categoria = $datos_validados['categoria'];
        
        $paciente->save();

        if(is_null($paciente->numero_cuenta)){

            DB::table('logins')->insert([
                'cuenta' => $paciente->numero_identidad,
                'password' => bcrypt($request->input(['password'])),
                'id_rol' => 1,
            ]);            

        }

        
    

    }

    public function ultimoID(){

        $id= DB::select('SELECT MAX(id_paciente) as ultimoId FROM pacientes');

        return response()->json($id);

        
    }


    public function obtenerColumnaNumeroTelefono($telefono){

        
        $telefonos = DB::table('telefonos_pacientes')->select('telefono')
        ->where('telefono', $telefono)
        ->first();
        
        return response()->json($telefonos);

    }

    public function obtenerColumnaIdentidad($numero_identidad){


        $identidad = DB::table('pacientes')->select('numero_identidad')
        ->where('numero_identidad', $numero_identidad)
        ->first();
        
        return response()->json($identidad);

    }
    //ESto
    public function obtenerColumnaNumeroCuenta($numero_cuenta){


        $cuenta = DB::table('pacientes')->select('numero_cuenta')
        ->where('numero_cuenta', $numero_cuenta)
        ->first();
        
        return response()->json($cuenta);

    }
    public function obtenerColumnaCorreo($correo_electronico){


        $correo = DB::table('pacientes')->select('correo_electronico')
        ->where('correo_electronico', $correo_electronico)
        ->first();
        
        return response()->json($correo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_paciente)
    {

        
        if($request->input('contrasenia')!= null){
            $nuevaContra = $request->input('contrasenia');

            DB::table('pacientes')
            ->where('id_paciente', $id_paciente)
            ->update(['contrasenia' =>  $nuevaContra]);

        }

        if($request->input('nombre_completo')!=null){

            $nombre_completo = $request->input('nombre_completo');            
            $correo_electronico = $request->input('correo_electronico');
            $numero_cuenta = $request->input('numero_cuenta');
            $numero_identidad = $request->input('numero_identidad');
            $imagen = $request->input('imagen'); 
            $direccion = $request->input('direccion');
            $carrera = $request->input('carrera');
            $lugar_procedencia = $request->input('lugar_procedencia');
            $fecha_nacimiento = $request->input('fecha_nacimiento');
            $sexo = $request->input('sexo');

            $seguro_medico = $request->input('seguro_medico');
            $estado_civil = $request->input('estado_civil');
            $categoria = $request->input('categoria');           
           
            $imc = $request->input('imc');
            $peso = $request->input('peso');
            $presion = $request->input('presion');
            $talla = $request->input('talla');
            $temperatura = $request->input('temperatura');
            $pulso = $request->input('pulso');  
            $prosene = $request->input('prosene');  
  
           

            $contrasenia = $request->input('contrasenia');
            

            DB::table('pacientes')
            ->where('id_paciente', $id_paciente)
            ->update([

                'nombre_completo'=> $nombre_completo,
                'correo_electronico'=> $correo_electronico,
                'numero_cuenta' => $numero_cuenta,
                'numero_identidad' => $numero_identidad, 
                'imagen' => $imagen,
                'direccion' => $direccion,                           
                'carrera' => $carrera,
                'lugar_procedencia' => $lugar_procedencia,
                'fecha_nacimiento' => $fecha_nacimiento, 
                'sexo' => $sexo,
                'estado_civil' => $estado_civil,
                'imc' => $imc,
                'peso' => $peso,
                'presion' => $presion,
                'talla' => $talla,
                'temperatura' => $temperatura,
                'pulso' => $pulso,
                'prosene' => $prosene,
                'seguro_medico' => $seguro_medico,
               'categoria' => $categoria,
            ]);

        
        }

                 
       
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }


    public function obtenerPaciente(Request $request){

        

        $usuario = DB::table('pacientes')->where('numero_cuenta', $request->cuenta)->first();

            // return response()->json($usuario);

        if(!isset($usuario)){

            $usuario = DB::table('pacientes')->where('numero_identidad', $request->cuenta)->first();

            return response()->json($usuario);
    

        }else{
        
            return response()->json($usuario);
    
        }
        


    }

    public function cantidad()
    {
     //   $cantidadPaciente = 
       // DB::select('SELECT *  FROM pacientes');


        $si= 
        DB::select('SELECT COUNT(id_paciente) as CantidadTotal FROM pacientes');

        return response()->json($si);    
        
    }

    public function actualizarfoto(Request $request){
        $paciente = new Paciente();

        $paciente->imagen = $request->input('imagen');
        $paciente->id_paciente = $request->input('id_paciente');
        $modificacion = Paciente::where('id_paciente',$request->input('id_paciente'))->first();
        $new = Paciente::where('id_paciente', $paciente->id_paciente)
            ->update(['imagen' =>  $paciente->imagen]);
        
    }


    public function contarPacientes(){

        $estudiantes = 
        DB::select('SELECT COUNT(pacientes.categoria) as estudiantes FROM pacientes where categoria = 3');

        $visitantes = 
        DB::select('SELECT COUNT(pacientes.categoria) as visitantes FROM pacientes where categoria = 2');

        $empleados = 
        DB::select('SELECT COUNT(pacientes.categoria) as empleados FROM pacientes where categoria = 1');

        $prosenes =
        DB::select('SELECT COUNT(prosene) as prosenes FROM pacientes where prosene = 1');

        



        return response()->json([
            'estudiantes' => $estudiantes[0]->estudiantes,
            'empleados' => $empleados[0]->empleados,
            'visitantes' => $visitantes[0]->visitantes,
            'prosenes' => $prosenes[0]->prosenes
        ]);

        
    }

    


}
