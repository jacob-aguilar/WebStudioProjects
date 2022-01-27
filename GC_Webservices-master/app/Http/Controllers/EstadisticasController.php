<?php

namespace App\Http\Controllers;

use App\Grasa;
use App\Imc;
use App\PagoClientesP;
use App\Ruffier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Cliente;

class EstadisticasController extends Controller
{
    //funcion para mostrar los clientes en general(estudiantes,docentes y particulares)
    public function index()
    {
        $clientes = Cliente::join("tipo_clientes",
            "clientes_gym.id_tipo_cliente", "=", "tipo_clientes.id")
            ->join('carreras','clientes_gym.id_carrera','=','carreras.id')
            ->select("clientes_gym.*", "tipo_clientes.descripcion","carreras.carrera")
            ->paginate(10);

        $obesidadTipoIII= Imc::
        join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
        ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo III")->get();


        $obesidadTipoII= Imc::  join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo II")->get();


        $obesidadTipoI= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo I")->get();


        $preobesidad= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","preobesidad")->get();


        $pesoNormal= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","peso normal")->get();



        $delgadez= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","delgadez")->get();



        $delgadezSevera= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","delgadez severa")->get();


        session()->flashInput([]);
        return view('estadisticas',["obesidadTipoIII"=>$obesidadTipoIII,"obesidadTipoII"=>$obesidadTipoII,
            "obesidadTipoI"=>$obesidadTipoI, "preobesidad"=>$preobesidad, "pesoNormal"=>$pesoNormal,
            "delgadez"=>$delgadez, "delgadezSevera"=>$delgadezSevera])->with('clientes', $clientes)->with('no',1);

    }


    public function create()
    {

        return view('estadisticas');
    }

    //funcion para mostrar los pagos de los clientes
    public  function  show($id){
        $cliente = Cliente::findOrfail($id);

        if($cliente->id_tipo_cliente==1){

            $pagos = PagoClientesP::where("tipo_pago", "=", "Pago_Estudiante")
                ->where("id_cliente", "=", $id)
                ->orderBy("fecha_pago", "asc")
                ->get()
                ->groupBy(function ($item) {
                    return strtolower(Carbon::createFromFormat("Y-m-d", $item->fecha_pago, null)->year);
                });

        }
        if($cliente->id_tipo_cliente==3){

            $pagos = PagoClientesP::where("tipo_pago", "=", "Pago_Particular")
                ->where("id_cliente", "=", $id)
                ->orderBy("fecha_pago", "asc")
                ->get()
                ->groupBy(function ($item) {
                    return strtolower(Carbon::createFromFormat("Y-m-d", $item->fecha_pago, null)->year);
                });

        }
        if($cliente->id_tipo_cliente==2){

            $pagos = PagoClientesP::where("tipo_pago", "=", "Pago_Docente")
                ->where("id_cliente", "=", $id)
                ->orderBy("fecha_pago", "asc")
                ->get()
                ->groupBy(function ($item) {
                    return strtolower(Carbon::createFromFormat("Y-m-d", $item->fecha_pago, null)->year);
                });

        }

        $antecedentes = Imc::where("id_cliente","=",$id)->get();
        $grasas = Grasa::where("id_cliente","=",$id)->get();
            $datos = Ruffier::where("id_cliente","=",$id)->get();

       return view('verestadistica',compact("pagos","antecedentes","datos","cliente"))
           ->with("grasa_corporal",$grasas)->with('no',1)
           ->with('no2',1)->with('no3',1)->with('no4',1);
    }


    //funcion para buscar los clientes en general
    public function buscarCliente(Request $request){
        $busquedaCliente = $request->input("busquedaCliente");

        $clientes = Cliente::join("tipo_clientes",
            "clientes_gym.id_tipo_cliente", "=", "tipo_clientes.id")
            ->select("clientes_gym.*", "tipo_clientes.descripcion")
            ->where("nombre","like","%".$busquedaCliente."%")
            ->orWhere("fecha_de_ingreso","like","%".$busquedaCliente."%")
            ->paginate(10);
        session()->flashInput($request->input());

        $obesidadTipoIII= Imc::
        join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo III")->get();


        $obesidadTipoII= Imc::  join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo II")->get();


        $obesidadTipoI= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","Obesidad tipo I")->get();


        $preobesidad= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","preobesidad")->get();


        $pesoNormal= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","peso normal")->get();



        $delgadez= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","delgadez")->get();



        $delgadezSevera= Imc:: join("diagnostico_imcs","antecedentes.id_diagnostico","=","diagnostico_imcs.id")
            ->where("diagnostico_imcs.diagnostico","=","delgadez severa")->get();


        return view('estadisticas',["obesidadTipoIII"=>$obesidadTipoIII,"obesidadTipoII"=>$obesidadTipoII,
            "obesidadTipoI"=>$obesidadTipoI, "preobesidad"=>$preobesidad, "pesoNormal"=>$pesoNormal,
            "delgadez"=>$delgadez, "delgadezSevera"=>$delgadezSevera])->with('clientes', $clientes)->with('no',1);
    }



    public function borrarPagoEstadistica(Request $request)
    {
        PagoClientesP::destroy($request->input("id"));

        return $this->show($request->input("id_cliente"));
    }


    public function borrarGrasaEstadistica(Request $request)
    {
        Grasa::destroy($request->input("id"));

        return $this->show($request->input("id_cliente"));
    }
    public function borrarImcEstadistica(Request $request)
    {
        Imc::destroy($request->input("id"));

        return $this->show($request->input("id_cliente"));
    }
    public function borrarRuffierEstadistica(Request $request)
    {
        Ruffier::destroy($request->input("id"));

        return $this->show($request->input("id_cliente"));
    }


}
