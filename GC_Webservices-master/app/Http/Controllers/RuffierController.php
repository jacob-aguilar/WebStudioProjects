<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use App\Cliente;
use App\Imc;
use App\Ruffier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RuffierController extends Controller
{
    //
    public  $alerta=0;

    //funcion para mostrar la vista de ruffier
    public function index($id)
    {
        $datos = Ruffier ::join("diagnostico_ruffier","ruffier.id_diagnostico","=","diagnostico_ruffier.id")
        ->where("id_cliente","=",$id)
            ->select("diagnostico_ruffier.diagnostico","ruffier.*")
            ->orderBy("created_at","desc")->paginate(10);

        $ruffier = Ruffier::select(DB::raw("COUNT(*) as count , ruffiel"))
            ->whereYear('created_at', date('Y'))
            ->where("id_cliente", '=', $id)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('ruffiel');
        $cliente = Cliente::find($id);

        $chart = new UserChart();
        $chart->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']);

        $chart->dataset('Ruffiel', 'line', $ruffier)->options([
            'fill' => 'true',
            'borderColor' => '#0000FF',
        ]);
        if(($this->alerta)==1) {
            $this->alerta=0;

        return view('ruffiel',compact("datos","chart"))->with("cliente", $cliente)->with("no", 1)
            ->withExito("Registro ruffier creado con exito")->withError(null);

    }
        if(($this->alerta) ==2){
            $this->alerta=0;

            return view('ruffiel', compact("datos", "chart"))->with("cliente", $cliente)->with('no', 1)->withError("no se pudo realizar la acción");
        }


        return view('ruffiel', compact("datos", "chart"))->with("cliente", $cliente)->with('no', 1)->withExito(null)->withError(null);


    }

    //funcion para crear el calculo de ruffier de cada cliente
    public function create($id)
    {

        $now = Carbon::now();
        $cliente = Cliente::find($id);
        $imc = Imc::where("id_cliente", "=", $id)->latest("updated_at")->first();
        return view('botonruffier')->with("id",$id)->with("cliente",$cliente)->with("imc",$imc)->with("now", $now );

    }

    //funcion para habilitar la creacion de cada dato
    public function store(Request $request)
    {

        $nuevosDatos = new Ruffier();

        $nuevosDatos->pulso_r = $request->input('pulso_r');
        $nuevosDatos->pulso_a = $request->input('pulso_a');
        $nuevosDatos->pulso_d = $request->input('pulso_d');
        $nuevosDatos->ruffiel = $request->input('ruffiel');
        $nuevosDatos->id_diagnostico = $request->input('id_diagnostico');
        $nuevosDatos->mvo = $request->input('mvo');
        $nuevosDatos->mvoreal = $request->input('mvoreal');
        $nuevosDatos->mvodiagnostico = $request->input('mvodiagnostico');
        $nuevosDatos->id_cliente=$request->input("id");

        $nuevosDatos->save();

        //TODO redireccionar a una página con sentido.
        //Seccion::flash('message','ingreso correcto');
        //   return redirect('ruffiel');
        $this->alerta=1;
        return $this->index( $request->input("id"));

    }

    /*   public function show(Ruffier $ruffier)
       {

       }*/
    //funcion para editar los datos de ruffier
    public function edit($id,$id_cliente)
    {

        $cliente = Cliente::find($id);
        $rufierr = Ruffier::findOrFail($id);
        $id_cliente = Cliente::findOrFail($id_cliente);
        return view('botonruffiereditar')-> with("dato", $rufierr)->with("id",$id_cliente)->with("cliente",$cliente);

    }

    //funcion para actualizar los datos editados
    public function update(Request $request, $id)
    {



        $datonuevo = Ruffier::findOrFail($id);

        //Asignar los nuevos valores a los diferentes campos

        $datonuevo->pulso_r = $request->input('pulso_r');
        $datonuevo->pulso_a = $request->input('pulso_a');
        $datonuevo->pulso_d = $request->input('pulso_d');
        $datonuevo->ruffiel = $request->input('ruffiel');
        $datonuevo->id_diagnostico = $request->input('id_diagnostico');
        $datonuevo->mvo = $request->input('mvo');
        $datonuevo->mvoreal = $request->input('mvoreal');
        $datonuevo->mvodiagnostico = $request->input('mvodiagnostico');

        // Guardar los cambios
        $datonuevo->save();

        // Redirigir a la lista de todos los estudiantes.
        //return redirect('ruffiel');
      return $this->index($request->input("id_cliente"));


    }

    //funcion para eliminar los registros de ruffier
    public function destroy(Request $request)
    {
        Ruffier::destroy($request->input("id"));

        return $this->index($request->input("id_cliente"));
    }





    /*public function buscarEstudiante(Request $request){
        $busqueda = $request->input("busqueda");

        $estudiantes = Estudiante::where("nombre","like","%".$busqueda."%")
            ->orWhere("fecha_de_ingreso","like","%".$busqueda."%")
            ->paginate(10);

        return view('estudiantes')->with('estudiantes', $estudiantes);
    }*/



}


