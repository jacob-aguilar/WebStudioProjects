<?php

namespace App\Http\Controllers;

use App\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\PagoClientesP;

class PagoParticularController extends Controller
{
    //funcion para mostrar los pagos registrados de cada particular
    public function index($id){
        $pagos = PagoClientesP::where("tipo_pago","=","Pago_Particular")
            ->where("id_cliente","=",$id)
            ->orderBy("fecha_pago", "asc")
            ->get()
            ->groupBy(function ($item) {
                return strtolower(Carbon::createFromFormat("Y-m-d", $item->fecha_pago, null)->year);
            });
        $totalPagosParticulares = PagoClientesP::where("tipo_pago","=","Pago_Particular")
            ->where("id_cliente","=",$id)
            ->count();

        $totalIngresoParticular= $totalPagosParticulares *200;

        $nombre = Cliente::findOrfail($id);




        return view('pagosparticulares', compact("pagos"))
            ->with("nombre", $nombre)->with('no',1)->withIngresos($totalIngresoParticular);
    }

    //funcion para crear un nuevo pago
    public function create()
    {
        return view('pagosparticulares');
    }

    //funcion para habilitar la creacion de cada dato
    // y verificar que la fecha de pago no sea igual a una que ya esta
    public function store(Request $request)
    {


        $nuevoPagoClientee = new PagoClientesP();

        $nuevoPagoClientee->mes = $request->input('mes');
        $nuevoPagoClientee->nota = $request->input('nota');
        $verificarFecha = PagoClientesP::where("fecha_pago",
            "like", "%" . $request->input('fecha_pago') . "%")

            ->where("id_cliente","=",$request->input("id"));

        if ($verificarFecha->count() > 0) {
            return back()->with("error", "La fecha ingresada de pago ya existe");
        } else {

            $nuevoPagoClientee->fecha_pago = $request->input('fecha_pago');
            $nuevoPagoClientee->tipo_pago = "Pago_Particular";
            $nuevoPagoClientee->id_cliente = $request->input("id");

            $nuevoPagoClientee->save();

            //TODO redireccionar a una página con sentido.
            //Seccion::flash('message','Estudiante creado correctamente');
            return back()->with(["exito" => "Se agregó exitosamente"]);
            return $this->index($request->input("id"));
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
        return view('pagosparticulares')->with('pagos', $pagos);

    }

    //funcion para actualizar  un pago editado
    public function update(Request $request)
    {
        $this->validate($request, [
            'mes' => 'required',
            'fecha_pago' => 'required',
        ]);
        $user = PagoClientesP::findOrfail($request->input("particularpago_id"));
        $user->fecha_pago = $request->input("fecha_pago");
        $user->mes = $request->input("mes");
        $user->nota = $request->input("nota");
        $user->save();

        $pagosparticular1 = PagoClientesP::paginate(10);
        return back()->with(["exito" => "Se editó exitosamente el pago"]);
    }


    //funcion para borrar los pagos registrados de un particular
    public function destroy(Request $request)
    {
        PagoClientesP::destroy($request->input("id"));

        return back()->with(["exito" => "Se borró exitosamente el pago"]);
    }

}


