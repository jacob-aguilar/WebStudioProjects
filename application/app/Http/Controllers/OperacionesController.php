<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    public function mostrarFormulario(){
        return view('formulario');
    }
    public function sumar(Request $r){

        $r->validate([
            'n1' => 'required | integer | between : 100,1000',
            'n2' => 'required | integer | between : 100,1000'
        ]);
         $n1 = $r ->input('n1');
         $n2 = $r ->input('n2');
        $total = $n1 + $n2;


        return view('resultado')-> with('suma', $total);
    }
}
