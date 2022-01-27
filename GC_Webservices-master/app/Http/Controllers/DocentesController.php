<?php

namespace App\Http\Controllers;

use App\Grasa;
use App\Imc;
use App\PagoClientesP;
use App\Ruffier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Cliente;

class DocentesController extends Controller
{
    //funcion para mostrar la vista de docentes
    public function index()
    {
        $clientes = Cliente::where("id_tipo_cliente", "=", "2")
            ->paginate(10);
        //session()->flashInput([]);
        return view('docentes')->with('docentes', $clientes)->with('no',1);
        return view('docentes')->with('docentes', $clientes)->with('no', 1);
    }

   //funcion para crear un nuevo  estudiante
    public function create()

    {
        return view('docentes');
    }

    //funcion para habilitar la creacion de cada dato
    public function store(Request $request)
    {
        // Validar los datos al momento de ingresarlos
        $this->validate($request, [
            'nombre' => 'required',
            'fecha_nacimiento' => 'required|max:' . date("Y-m-d", strtotime("-1825 days")),
            'identificacion' => 'required|unique:clientes_gym|max:99999|min:00000|numeric',
            'telefono' => 'required|unique:clientes_gym|max:99999999|numeric',
            'genero' => 'required',

        ]);
        if (strtoupper($request->input("genero")) === "F" || strtoupper($request->input("genero")) === "M") {

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

            $nuevoDocente = new Cliente();
            $nuevoDocente->nombre = $request->input('nombre');
            $nuevoDocente->identificacion = $request->input('identificacion');
            $nuevoDocente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $nuevoDocente->telefono = $request->input('telefono');
            $nuevoDocente->profesion_u_oficio = $request->input("profesion_u_oficio");
            $nuevoDocente->genero = $request->input('genero');
            $nuevoDocente->id_carrera = 1;
            $nuevoDocente->id_tipo_cliente = "2";
            $nuevoDocente->imagen = $imagen;


            $nuevoDocente->save();

            //TODO redireccionar a una página con sentido.
            //Seccion::flash('message','Estudiante creado correctamente');

            return back()->with(["exito" => "Se agregó exitosamente"]);
        } else {
            return back()->with("error", "El genero ingresado no es el correcto");

        }
    }

    //funcion para editar los datos un docente
    public function edit($id)
    {
        $clientes = Cliente::findOrFail($id);
        return view('docentes')->with('docente', $clientes);

    }

    //funcion para actualizar los datos editados
    public function update(Request $request)
    {


        // Validar los datos actualizados
        $this->validate($request, [
            'identificacion' => 'required|max:99999|numeric|unique:clientes_gym,identificacion,' . $request->input("docente_id"),
            'telefono' => 'required|max:99999999|numeric|unique:clientes_gym,telefono,' . $request->input("docente_id") . '',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required|max:' . date("Y-m-d", strtotime("-1825 days")),
            'genero' => 'required'
        ]);
        if (strtoupper($request->input("genero")) === "F" || strtoupper($request->input("genero")) === "M") {

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

            // Buscar la instancia en la base de datos.

            // Asignar los nuevos valores a los diferentes campos
            $docente = Cliente::findOrfail($request->input("docente_id"));
            $docente->nombre = $request->input('nombre');
            $docente->fecha_nacimiento = $request->input('fecha_nacimiento');
            $docente->identificacion = $request->input('identificacion');
            $docente->telefono = $request->input('telefono');
            $docente->profesion_u_oficio = $request->input("profesion_u_oficio");
            $docente->genero = strtoupper($request->input('genero'));
            $docente->id_carrera = 1;
            $docente->id_tipo_cliente = "2";
            if($imagen!=="") {
                $docente->imagen = $imagen;
            }
            $docente->save();


            $docente = Cliente::paginate(10);
            return back();


        } else {
            return back()->with("error", "El genero ingresado no es el correcto");
        }
    }

    //funcion para eliminar los registros del docente
    public function destroy(Request $request)
    {
        $imc = Imc::where("id_cliente", "=", $request->input("id"));
        $grasa = Grasa::where("id_cliente", "=", $request->input("id"));
        $ruffier = Ruffier::where("id_cliente", "=", $request->input("id"));
        $pagos = PagoClientesP::where("id_cliente", "=", $request->input("id"));

        if ($imc->count() > 0 || $grasa->count() > 0 || $ruffier->count() > 0 || $pagos->count() > 0) {

            return back()->with(["error" => "No se puede borrar
             el docente porque tiene datos ingresados"]);

        } else {
            $cliente = Cliente::destroy($request->input("id"));

            if ($cliente) {
                return back()->with(["exito" => "Se elimino exitosamente"]);
            } else {
                return back()->with(["error" => "El docente ingresado no existe"]);
            }
        }

    }

    //funcion para la busqueda de un docente
    public function buscarDocente(Request $request)
    {
        $busquedaDocente = $request->input("busquedaDocente");

        $docentes = Cliente::where("id_tipo_cliente", "=", 2)
            ->where("nombre", "like", "%" . $busquedaDocente . "%")

            ->paginate(10);
        session()->flashInput($request->input());

        return view('docentes')->with('docentes', $docentes)->with('no', 1);
    }


}
