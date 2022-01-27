<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class antecedentesFamiliares extends Model
{
    // un antecedente_familiar pertenece a un paciente
    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
