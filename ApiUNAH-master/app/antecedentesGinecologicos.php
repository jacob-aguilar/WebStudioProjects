<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class antecedentesGinecologicos extends Model
{
    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
