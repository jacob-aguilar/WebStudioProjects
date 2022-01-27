<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class DiagnosticoRuffier extends Model
{
    protected $table="diagnostico_ruffier";
    protected $fillable =["diagnostico"];
}
