<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//clase que representa la informacion con la cual va operar el sistemas
class Particular extends Model
{
    protected $table = 'particulares';
    protected $appends =["edad"];

    protected $fillable =[
        'nombre',
        'fecha_nacimiento',
        'numero_de_identidad',
        'profesion_u_oficio',
        'telefono',
        "imagen"
    ];
}
