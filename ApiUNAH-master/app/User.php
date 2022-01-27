<?php
namespace  App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User  as Authenticatable;

class  User  extends  Authenticatable  implements  JWTSubject {
	use  Notifiable;

	protected $table = 'logins'; // colocamos el nombre de la tabla
	protected $primaryKey = 'id_login';

	protected  $fillable = [
		'id_login','cuenta', 'password', 'nombre', 'carrera','centro','numero_identidad','imagen'
	];

	protected  $hidden = [
		'password', 'remember_token',
	];

	protected  $casts = [
		'email_verified_at' => 'datetime',
	];

	public  function  getJWTIdentifier() {
		return  $this->getKey();
	}

	public  function  getJWTCustomClaims() {
		return [];
	}
}