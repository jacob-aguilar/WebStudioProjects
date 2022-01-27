<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\PagoClientesP;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagoEstudianteController extends Controller
{
    //funcion para mostrar los pagos registrados de cada estudiante
    public function index($id)
    {
        $pagos = PagoClientesP::where("tipo_pago", "=", "Pago_Estudiante")
            ->where("id_cliente", "=", $id)
            ->orderBy("fecha_pago", "asc")
            ->get()
            ->groupBy(function ($item) {
                return strtolower(Carbon::createFromFormat("Y-m-d", $item->fecha_pago, null)->year);
            });

        $totalPagosEstudiantes = PagoClientesP::where("tipo_pago","=","Pago_Estudiante")
            ->where("id_cliente","=",$id)
            ->count();

        $totalIngresoEstudiante= $totalPagosEstudiantes *100;



        $nombre = Cliente::findOrfail($id);

        return view('pagosestudiantes', compact("pagos"))
            ->with("nombre", $nombre)->with('no',1)->withIngresos($totalIngresoEstudiante);
    }

    //funcion para crear un nuevo pago
    public function create()
    {
        return view('pagosestudiantes');
    }

    //funcion para habilitar la creacion de cada dato
    // y verificar que la fecha de pago no sea igual a una que ya esta
    public function store(Request $request)
    {

        $nuevoPagoCliente = new PagoClientesP();

        $nuevoPagoCliente->mes = $request->input('mes');
        $nuevoPagoCliente->nota = $request->input('nota');
        $verificarFecha = PagoClientesP::where("fecha_pago",
            "like", "%" . $request->input('fecha_pago') . "%")
        ->where("id_cliente","=",$request->input("id"));

        if ($verificarFecha->count() > 0) {
            return back()->with("error", "La fecha ingresada de pago ya existe");
        } else {

            $nuevoPagoCliente->fecha_pago = $request->input('fecha_pago');
            $nuevoPagoCliente->tipo_pago = "Pago_Estudiante";
            $nuevoPagoCliente->id_cliente = $request->input("id");


            $nuevoPagoCliente->save();

            //TODO redireccionar a una página con sentido.
            //Seccion::flash('message','Estudiante creado correctamente');
            return back()->with(["exito" => "Se agregó exitosamente"]);
        }
    }

    //funcion para mostrar un pago de un estudiante
    public function show(PagoClientesP $pagoClientes)
    {

    }

    //funcion para editar un pago
    public function edit($id)
    {
        $pagos = PagoClientesP::findOrFail($id);
        return view('pagosestudiantes')->with('pagos', $pagos);

    }

    //funcion para actualizar  un pago editado
    public function update(Request $request)
    {
        $this->validate($request, [
            'fecha_pago' => 'required',
            'mes'=> 'required'
            ]);
        $user = PagoClientesP::findOrfail($request->input("estudiantepago_id"));
        $user->fecha_pago = $request->input("fecha_pago");
        $user->mes = $request->input("mes");
        $user->nota = $request->input("nota");
        $user->save();

        $pagosestudiante1 = PagoClientesP::paginate(10);
        return back()->with(["exito" => "Se editó exitosamente el pago"]);


    }

   //funcion para borrar los pagos registrados de un estudiante
    public function destroy(Request $request)
    {

        PagoClientesP::destroy($request->input("id"));

        return back()->with(["exito" => "Se borró exitosamente el pago"]);

    }

    public function buscarPagos(Request $request)
    {
        $busquedaPagos = $request->input("busquedaPago");

        $pagoestudiantes = PagoClientesP::where("mes", "like", "%" . $busquedaPagos . "%")
            ->orWhere("fecha_pago", "like", "%" . $busquedaPagos . "%")
            ->paginate(10);

        return view('pagoestudiantes')->with('pagoestudiantes', $pagoestudiantes);

    }


}

