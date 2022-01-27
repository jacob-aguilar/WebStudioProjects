<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Imc extends Model
{
    protected $table = 'antecedentes';

    protected $fillable =[
        'peso',
        'altura',
        'imc',
        'id_diagnostico',
        'pecho',
        'brazo',
        'ABD_A',
        'ABD_B',
        'cadera',
        'muslo',
        'pierna',
        "id_cliente"
    ];

}
