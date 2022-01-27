<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class habitosToxicologicosPersonales extends Model
{
    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
