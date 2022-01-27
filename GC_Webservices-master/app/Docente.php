<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Docente extends Model
{
    protected $table = 'docentes';
    protected $appends =["edad"];
    protected $fillable =[
        'nombre',
        'numero_de_empleado',
        'telefono',
        'fecha_nacimiento',
        'imagen'
    ];
}
