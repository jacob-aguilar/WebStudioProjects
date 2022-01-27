<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Carrera extends Model
{
    protected $table="carreras";
    protected $fillable =["carrera"];
}
