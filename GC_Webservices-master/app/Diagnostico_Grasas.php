<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase que representa la informacion con la cual va operar el sistemas
class Diagnostico_Grasas extends Model
{
    protected $table="diagnostico_grasas";
    protected $fillable=["diagnostico"];
}
