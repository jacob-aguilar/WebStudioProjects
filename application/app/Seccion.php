<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    //
    protected $table="secciones";

    public function alumnos(){
    	return $this->belongsToMany('App\Alumno');
    }

    
}