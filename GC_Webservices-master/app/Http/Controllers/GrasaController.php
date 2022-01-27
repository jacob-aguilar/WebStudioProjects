<?php

namespace App\Http\Controllers;


use App\Charts\UserChart;
use App\Cliente;

use App\Estudiante;
use App\Imc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Grasa;
use Illuminate\Support\Facades\DB;



class GrasaController extends Controller
{
    public  $alerta=0;
    //funcion para mostrar la vista de grasa corporal
    public function index($id)
    {

        $grasa_corporal = Grasa::
        join("diagnostico_grasas","grasa_corporal.id_diagnostico","=","diagnostico_grasas.id")
            ->where("id_cliente", "=", $id)
            ->select("diagnostico_grasas.diagnostico","grasa_corporal.*")
            ->orderBy("created_at","desc")->paginate(10);

        $grasa = Grasa::select(DB::raw("COUNT(*) as count , grasa"))
            ->whereYear('created_at', date('Y'))
            ->where("id_cliente", '=', $id)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('grasa');

        $nombre = Cliente::findOrfail($id);

        $chart = new UserChart();
        $chart->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']);

        $chart->dataset('Grasa', 'line', $grasa)->options([
            'fill' => 'true',
            'borderColor' => '#CD5C5C',
        ]);
        if(($this->alerta)==1) {
            $this->alerta = 0;

            return view('grasa', compact("grasa_corporal", "chart"))->with("nombre", $nombre)->with('no', 1)
           -> withExito("Registro grasa creado con exito")->withError(null);
        }
        //$grasa_corporal = Grasa
        // ::where("id_cliente", "=", $request->input("id_cliente"));
        //$nombre = Cliente::findOrfail($id);
        // return view('grasa', compact("grasa_corporal"))->with("nombre", $nombre);
        if(($this->alerta) ==2){
            $this->alerta=0;

            return view('grasa', compact("grasa_corporal", "chart"))->with("nombre", $nombre)->with('no', 1)->withError("no se pudo realizar la acción");
        }


        return view('grasa', compact("grasa_corporal", "chart"))->with("nombre", $nombre)->with('no', 1)->withExito(null)->withError(null);
    }


    //funcion para crear el calculo de la grasa corporal de cada cliente
    public function create($id)
    {

        $now = Carbon::now();
        $nombre = Cliente::find($id);
        return view('botongrasa')->with("id", $id)->with("now", $now)->with("now", $now)
            ->with("nombre",$nombre);

    }

    //funcion para habilitar la creacion de cada dato
    public function store(Request $request)
    {
        $nuevoMedida = new Grasa();

        $nuevoMedida->pc_tricipital = $request->input('pc_tricipital');
        $nuevoMedida->pc_infraescapular = $request->input('pc_infraescapular');
        $nuevoMedida->pc_supra_iliaco = $request->input('pc_supra_iliaco');
        $nuevoMedida->pc_biciptal = $request->input('pc_biciptal');
        $nuevoMedida->grasa = $request->input('grasa');
        $nuevoMedida->id_diagnostico = $request->input('id_diagnostico');
        $nuevoMedida->id_cliente = $request->input("id");
        $nuevoMedida->save();

        // TODO redireccionar a una página con sentido.
        $this->alerta=1;
        return $this->index( $request->input("id"));

    }

    //funcion para editar los datos de grasa corporal
    public function edit($id_cliente,$id)

    {

        $nombre = Cliente::find($id);
        $grasa = Grasa::findOrfail($id);
        $id_cliente = Cliente::findOrFail($id_cliente);
        return view('botongrasaeditar')->with("grasa", $grasa)->with("id", $id_cliente)->with("nombre",$nombre);

    }

    //funcion para actualizar los datos editados
    public function update(request $request, $id)
    {
        /* $this -> validate ( $request ,[
             'fecha_de_ingreso'=>'required|numeric',
             'edad'=>'required|numeric|max:100|min:10',
             'imc'=>'required',
             'grasa'=>'',
             'leyenda'=>'',

         ]);  */

        $medida = Grasa::findOrfail($id);



        $medida->pc_tricipital = $request->input('pc_tricipital');
        $medida->pc_infraescapular = $request->input('pc_infraescapular');
        $medida->pc_supra_iliaco = $request->input('pc_supra_iliaco');
        $medida->pc_biciptal = $request->input('pc_biciptal');
        $medida->grasa = $request->input('grasa');
        $medida->id_cliente = $request->input("id_cliente");
        $medida->id_diagnostico = $request->input('id_diagnostico');


        $medida->save();
        return $this->index($request->input("id_cliente"));
    }


    //funcion para eliminar los registros de grasa corporal
    public function destroy(Request $request)
    {
        Grasa::destroy($request->input("id"));

        return $this->index($request->input("id_cliente"));
    }

}

