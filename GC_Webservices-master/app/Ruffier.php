<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//clase que representa la informacion con la cual va operar el sistemas
class Ruffier extends Model
{
    //
    protected $table='ruffier';

    protected $fillable =[
        'pulso_r',
        'pulso_a',
        'pulso_d',
        'id_diagnostico',
        'mvo',
        'mvoreal',
        "id_cliente",
        "mvodiagnostico"
        ];
//Metdo que retornara el resultado del diagnostico
    public function diagnostico()
    {
        return $this->belongsTo('App\Ruffier',"id_diagnostico");//modelo
    }
}

