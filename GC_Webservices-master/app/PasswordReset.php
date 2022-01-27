<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//clase que representa la informacion con la cual va operar el sistemas
class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}
