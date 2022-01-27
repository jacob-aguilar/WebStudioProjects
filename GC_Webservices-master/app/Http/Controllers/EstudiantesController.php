<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Grasa;
use App\Imc;
use App\PagoClientes;
use App\PagoClientesP;
use App\Ruffier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Cliente;
use mysql_xdevapi\Session;

class  EstudiantesController extends Controller
{
    //funcion para mostrar la vista de estudiantes
    public function index()
    {
        $clientes = Cliente::where("id_tipo_cliente","=","1")
            ->join("carreras","clientes_gym.id_carrera","=","carreras.id")
            ->select("clientes_gym.*","carreras.carrera")
            ->paginate(10);

        $totalEstudiantes= Cliente::where("id_tipo_cliente","=",1)->count();
        $totalPagosEstudiantes = PagoClientesP::where("tipo_pago",
            "=","Pago_Estudiante")->count();

        $totalIngresoEstudiante= $totalPagosEstudiantes *100;
        $totalIngresos = $totalIngresoEstudiante;

        $carrera = Carrera::all();
       // session()->flashInput([]);
        return view('estudiantes')->with('estudiantes', $clientes)
            ->with("carreras",$carrera)->with("no", 1)
            ->with("totalEstudiantes",$totalEstudiantes)
            ->withIngresos($totalIngresos);
    }

    //funcion para crear un nuevo  estudiante
    public function create($id)
    {
        $now = Carbon::now();
        return view('estudiantes')->with("id", $id)->with("now", $now);
    }

   //funcion para habilitar la creacion de cada dato
    public function store(Request $request)
    {
        // Validar los datos al momento de ingresarlos
      $this->validate($request,[
          'identificacion'=>'required|unique:clientes_gym|max:99999999999|numeric',
         'telefono'=>'required|unique:clientes_gym|max:99999999|numeric',
          'nombre'=>'required',
          'carrera'=>'required',
          'genero'=>'required',
        ]);
        if(strtoupper($request->input("genero"))==="F"||strtoupper($request->input("genero"))==="M") {

            $carreraExiste = Carrera::where("id","=", $request->input('carrera'));
            if($carreraExiste->count()>0) {

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

                $nuevoEstudiante = new Cliente();

                $nuevoEstudiante->nombre = $request->input('nombre');
                $nuevoEstudiante->fecha_nacimiento = $request->input('fecha_nacimiento');
                $nuevoEstudiante->identificacion = $request->input('identificacion');
                $nuevoEstudiante->id_carrera = $request->input('carrera');
                $nuevoEstudiante->telefono = $request->input('telefono');
                $nuevoEstudiante->id_tipo_cliente = "1";
                $nuevoEstudiante->genero = strtoupper($request->input("genero"));

                $nuevoEstudiante->imagen=$imagen;

                $nuevoEstudiante->save();

                //TODO redireccionar a una página con sentido.
                //Seccion::flash('message','Estudiante creado correctamente');

                return back()->with(["exito" => "Se agregó exitosamente"]);
            }else{

                return back()->with(["error" => "La carrera ingresada no existe"]);
            }

        }else{
            return back()->with("error","El genero ingresado no es el correcto");

        }
    }

    public function show(Cliente $estudiantes)
    {

    }

    //funcion para editar los datos un estudiante
    public function edit($id)
    {
        $estudiante = Cliente::where("id",$id)->where("id_tipo_cliente","=",1);
        return view('estudiantes')->with('estudiante', $estudiante);

    }

    //funcion para actualizar los datos editados
    public function update(Request $request)
    {



        // Validar los datos actualizados
        $this->validate($request, [
            'identificacion' => 'required|max:99999999999|numeric|unique:clientes_gym,identificacion,' . $request->input("estudiante_id") ,
            'telefono' => 'required|max:99999999|numeric|unique:clientes_gym,telefono,' . $request->input("estudiante_id") . '',
            'nombre' => 'required',
            'carrera' => 'required',
            'genero' => 'required',
        ]);

        if (strtoupper($request->input("genero")) === "F" || strtoupper($request->input("genero")) === "M") {

            $carreraExiste = Carrera::where("id", "=", $request->input('carrera'));
            if ($carreraExiste->count() > 0) {
                $imagen = $_FILES["imagen"]["name"];
                $ruta = $_FILES["imagen"]["tmp_name"];
                if($_FILES["imagen"]["name"]) {
                    $destino = "clientes_imagenes/" . $imagen;
                    copy($ruta, $destino);
                } else{
                    if(strtoupper($request->input("genero"))==="F"){
                        $imagen="woman.png";
                    }else{
                        $imagen="young.png";
                    }

                }
                $nuevoEstudiante = new Cliente();


                // Buscar la instancia en la base de datos.
                $estudiantes = Cliente::findOrfail($request->input("estudiante_id"));
                $estudiantes->nombre = $request->input("nombre");
                $estudiantes->fecha_nacimiento = $request->input("fecha_nacimiento");
                $estudiantes->identificacion = $request->input("identificacion");
                $estudiantes->id_carrera = $request->input("carrera");
                $estudiantes->telefono = $request->input("telefono");
                $estudiantes->id_tipo_cliente = "1";
                $estudiantes->genero = strtoupper($request->input("genero"));
                if($imagen!=="") {
                    $estudiantes->imagen = $imagen;
                }
                $estudiantes->save();

                $estudiantes1 = Cliente::paginate(10);
                return back();
            }else{

                return back()->with(["error" => "La carrera ingresada no existe"]);
            }


            } else {
                return back()->with("error", "El genero ingresado no es el correcto");
            }
        }

    //funcion para eliminar los registros del estudiante
    public function destroy(Request $request)
    {
        $imc=Imc::where("id_cliente","=",$request->input("id"));
        $grasa = Grasa::where("id_cliente","=",$request->input("id"));
        $ruffier = Ruffier::where("id_cliente","=",$request->input("id"));
        $pagos = PagoClientesP::where("id_cliente","=",$request->input("id"));

        if($imc->count()>0||$grasa->count()>0||$ruffier->count()>0||$pagos->count()>0){

            return back()->with(["error"=>"No se puede borrar
             el estudiante porque tiene datos ingresados"]);

        }else {
           $cliente=  Cliente::destroy($request->input("id"));

            if ($cliente){
                return back()->with(["exito" => "Se elimino exitosamente"]);
            }else{
                return back()->with(["error" => "El estudiante ingresado no existe"]);
            }

        }

    }

    //funcion para la busqueda de un estudiante
    public function buscarEstudiante(Request $request){
        $busquedaEstudiante = $request->input("busquedaEstudiante");


        $carrera = Carrera::all();

        $clientes = Cliente:: where("id_tipo_cliente","=","1")
            ->join("carreras","clientes_gym.id_carrera","=","carreras.id")
            ->select("clientes_gym.*","carreras.carrera")
        ->where("nombre","like","%".$busquedaEstudiante."%")
            ->paginate(10);
        $carrera = Carrera::all();
        session()->flashInput($request->input());
        return view("estudiantes")->with('estudiantes', $clientes)->with("carreras",$carrera)->with("no", 1)
            ->with("busqueda",$busquedaEstudiante);
    }





    /*public function buscarEstudiante(Request $request){
        $busqueda = $request->input("busqueda");

        $estudiantes = Estudiante::where("nombre","like","%".$busqueda."%")
            ->orWhere("fecha_de_ingreso","like","%".$busqueda."%")
            ->paginate(10);

        return view('estudiantes')->with('estudiantes', $estudiantes);
    }*/





}
