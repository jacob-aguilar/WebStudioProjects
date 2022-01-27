<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    
	//Ejemplo de cuando especificar 
	//protected $table="estudiantes";

	public function telefonos(){
		return $this->hasMany('App\Telefono');
	}

	public function secciones(){
		return $this->belongToMany('Seccion');
	}


}
