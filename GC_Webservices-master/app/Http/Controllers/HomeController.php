<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\PagoClientesP;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //funcion para mostrar los totales de estudiantes,particulares,docentes y pagos en las card de
    //la vista de inicio
    public function index()
    {
        $totalEstudiantes= Cliente::where("id_tipo_cliente","=",1)->count();
        $totalDocentes= Cliente::where("id_tipo_cliente","=",2)->count();
        $totalParticulares= Cliente::where("id_tipo_cliente","=",3)->count();
        $totalPagosEstudiantes = PagoClientesP::where("tipo_pago","=","Pago_Estudiante")->count();
        $totalPagosParticulares  =PagoClientesP::where("tipo_pago","=","Pago_Particular")->count();

        $totalIngresoEstudiante= $totalPagosEstudiantes *100;
        $totalIngresoParticulares= $totalPagosParticulares *200;


        $totalIngresos = $totalIngresoEstudiante+$totalIngresoParticulares;

        return view('home')
            ->with("ingresos",$totalIngresos)
            ->with("estudiantes",$totalEstudiantes)
            ->with("docentes",$totalDocentes)
            ->with("particulares",$totalParticulares);

    }
}
