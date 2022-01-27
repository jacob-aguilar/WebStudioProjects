<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    //

   public function alumno(){
		return $this->belongsTo('App\Alumno');//Un telefono pertenece a un alumno
	
	}
}
