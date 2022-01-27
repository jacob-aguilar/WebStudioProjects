<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planificacionesFamiliares extends Model
{
    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
