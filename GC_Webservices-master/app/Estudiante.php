<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $appends =["edad"];
    protected $fillable =[
       'nombre',
        'fecha_nacimiento',
        'numero_de_cuenta',
        'carrera',
        'telefono',

    ];

}

