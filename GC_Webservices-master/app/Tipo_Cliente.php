<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Tipo_Cliente extends Model
{
    protected $table="tipo_clientes";
    protected $fillable =["descripcion"];
}
