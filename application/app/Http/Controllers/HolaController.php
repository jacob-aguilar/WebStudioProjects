<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolaController extends Controller
{
    //Me lleva a 2 vistas (blade.php)
    public function holaMundo($nombress){
        return view('saludo')-> with('nombre', $nombress);
    }
    public function hola($name){
        return 'Hola '.$name;
    }
    public function usuario($id){
        return 'Usuario numero: '.$id;
    }
    public function otra(){
        $nombres = ["Juan", "Marcos","Pedro","Alex","Marvin","Pavlichenko"];
        return view('otra')-> with('nombres', $nombres);
    }
    public function tablas($numero){
        return view('tablas')-> with('num', $numero);
    }

    public function ejercicio1(){
        return view('ejercicio1');
    }
    public function respuesta(Request $r)
    {   
        //Reglas de validacion 
        $r->validate([
            'n1' => 'required| numeric',// las reglas van entre divididas por plecas verticales
            'n2' => 'required | numeric'
            ]);
            // validaciones: alpha solo vayan letras, date que se fecha, numeric que sean numericos, exists que exista en una base de datos
        // array: que sean arreglos, between, integer que se entero, same, starst with 
        $n1 = $r->input('n1');
        $n2 = $r->input('n2');
        
        return view('ejercicio', ['n1'=> $n1, 'n2'=> $n2]) ;

    }
    
}
