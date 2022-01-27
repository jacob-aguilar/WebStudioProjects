<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//clase que representa la informacion con la cual va operar el sistemas
class PagoClientesP extends Model
{
    protected $table = 'clientesp';

    protected $fillable =[
        'mes',
        'fecha_pago',
        'nota',
        "id_cliente"
    ];
}
