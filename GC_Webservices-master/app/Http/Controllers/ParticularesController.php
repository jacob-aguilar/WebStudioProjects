<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Grasa;
use App\Imc;
use App\PagoClientesP;
use App\Ruffier;
use Illuminate\Http\Request;

class ParticularesController extends Controller
{
    //funcion para mostrar la vista de particulares
    public function index () {
        $clientes = Cliente::where("id_tipo_cliente","=",3)
            ->paginate(10);
        $totalParticulares= Cliente::where("id_tipo_cliente","=",3)->count();
        $totalPagosParticulares  =PagoClientesP::where("tipo_pago","=","Pago_Particular")->count();
        $totalIngresoParticulares= $totalPagosParticulares *200;
        $totalIngresos = $totalIngresoParticulares;


        //session()->flashInput([]);
        return view('particulares')->with('particulares' , $clientes)->with('no',1)->with("totalParticulares",$totalParticulares)
            ->withIngresos($totalIngresos);;


    }

    //funcion para crear un nuevo  particular
    public function create() {
        return view('particulares');
    }

    //funcion para habilitar la creacion de cada dato
    public function store(Request $request) {
        // Validar los datos al momento de ingresarlos
        $this -> validate ( $request ,[
            'nombre'=>'required',
            'fecha_nacimiento'=>'required|max:'.date("Y-m-d",strtotime("-1825 days")),
            'identificacion'=>'required|unique:clientes_gym|max:9999999999999|numeric',
            'profesion_u_oficio'=>'required',
            'telefono'=>'required|unique:clientes_gym|max:99999999|numeric',
            'genero'=>'required',

        ]);
        if(strtoupper($request->input("genero"))==="F"||strtoupper($request->input("genero"))==="M") {

            $imagen = $_FILES["imagen"]["name"];
            $ruta = $_FILES["imagen"]["tmp_name"];
            if($_FILES["imagen"]["name"]!=null) {
                $destino = "clientes_imagenes/" . $imagen;
                copy($ruta, $destino);
            } else{
                if(strtoupper($request->input("genero"))==="F"){
                    $imagen="woman.png";
                }else{
                    $imagen="young.png";
                }
            }
            $nuevoParticular = new Cliente();

        $nuevoParticular->nombre = $request->input('nombre');
        $nuevoParticular->fecha_nacimiento = $request->input('fecha_nacimiento');
        $nuevoParticular->identificacion = $request->input('identificacion');
        $nuevoParticular->profesion_u_oficio = $request->input('profesion_u_oficio');
        $nuevoParticular->telefono = $request->input ('telefono');
        $nuevoParticular->id_carrera=1;
        $nuevoParticular->genero = $request->input ('genero');
        $nuevoParticular->id_tipo_cliente="3";
            $nuevoParticular->imagen=$imagen;
        $nuevoParticular->save();

        //TODO redireccionar a una página con sentido.
        //Seccion::flash('message','Estudiante creado correctamente');
        return back()->with(["exito"=>"Se agregó exitosamente"]);
        }else{
            return back()->with("error","El genero ingresado no es el correcto");

        }
    }

    //funcion para editar los datos un particular
    public function edit($id) {
        $clientes = Cliente::findOrFail($id);
        return view('particulares')->with('particulares',$clientes);

    }

    //funcion para actualizar los datos editados
    public function update(Request $request) {


        // Validar los datos actualizados
        $this -> validate ( $request ,[
            'identificacion'=>'required|max:9999999999999|unique:clientes_gym,identificacion,'.$request->input("particular_id").'|numeric',
            'telefono'=>'required|max:99999999|unique:clientes_gym,telefono,'.$request->input("particular_id").'|numeric',
            'nombre'=>'required',
            'fecha_nacimiento'=>'required|max:'.date("Y-m-d",strtotime("-1825 days")),
            'profesion_u_oficio'=>'required',
            'genero'=>'required',
        ]);
        if(strtoupper($request->input("genero"))==="F"||strtoupper($request->input("genero"))==="M") {

            $imagen = $_FILES["imagen"]["name"];
            $ruta = $_FILES["imagen"]["tmp_name"];
            if ($_FILES["imagen"]["name"]) {
                $destino = "clientes_imagenes/" . $imagen;
                copy($ruta, $destino);
            } else {
                if(strtoupper($request->input("genero"))==="F"){
                    $imagen="woman.png";
                }else{
                    $imagen="young.png";
                }
            }


            // Asignar los nuevos valores a los diferentes campos
        $particular = Cliente::findOrFail($request->input("particular_id"));
        $particular->nombre = $request->input('nombre');
        $particular->fecha_nacimiento = $request->input('fecha_nacimiento');
        $particular->identificacion = $request->input('identificacion');
        $particular->profesion_u_oficio = $request->input('profesion_u_oficio');
        $particular->telefono = $request->input ('telefono');
        $particular->id_carrera=1;
        $particular->genero = strtoupper( $request->input ('genero'));
        $particular->id_tipo_cliente="3";
            if($imagen!=="") {
                $particular->imagen = $imagen;
            }
        // Guardar los cambios
        $particular->save();

        // Redirigir a la lista de todos los estudiantes.
        $particular1 = Cliente::paginate(10);
        return back();


        }else{
            return back()->with("error","El genero ingresado no es el correcto");
        }
    }

    //funcion para eliminar los registros del particular
    public function destroy(Request $request)
    {



        $imc=Imc::where("id_cliente","=",$request->input("id"));
        $grasa = Grasa::where("id_cliente","=",$request->input("id"));
        $ruffier = Ruffier::where("id_cliente","=",$request->input("id"));
        $pagos = PagoClientesP::where("id_cliente","=",$request->input("id"));

        if($imc->count()>0||$grasa->count()>0||$ruffier->count()>0||$pagos->count()>0){

            return back()->with(["error"=>"No se puede borrar
             el particular porque tiene datos ingresados"]);

        }else {
            $cliente=  Cliente::destroy($request->input("id"));

            if ($cliente){
                return back()->with(["exito" => "Se elimino exitosamente"]);
            }else{
                return back()->with(["error" => "El particular ingresado no existe"]);
            }
        }

    }
    //funcion para la busqueda de un particular
    public function buscarParticular(Request $request){
        $busquedaPartarticular = $request->input("busquedaParticular");

        $particulares=Cliente::where("id_tipo_cliente","=","3")
        ->where("nombre","like","%".$busquedaPartarticular."%")
            ->paginate(10);
        session()->flashInput($request->input());


        return view('particulares')->with('particulares', $particulares)->with('no',1);

    }




}
