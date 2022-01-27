<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//clase que representa la informacion con la cual va operar el sistemas
class PagoClientes extends Model
{
    protected $table = 'clientes';

    protected $fillable =[
        'mes',
        'fecha_pago',
        "id_cliente"
    ];
}
