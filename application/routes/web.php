<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// name es igual que en la vista
// 
Route:: get('/fotos', function(){
    return view('fotos', ['name' => 'Jacob']);
});

Route::get('/hosting', function(){
    return view('Hosting');
});
Route::get('/holamundo/hola/{n}',function($n){
    return 'Hola '.$n;
});

/*Rutas con pamametros*/
Route:: get('/usuarios/{id}', function($id){
    return 'User '.$id;
});

/*Multiples parametros */
Route::get('/holamundo/{n}/{r}',function($n, $r){
    return 'Hola Mundo '.$n.' '.$r;
});

/*Parametros opcionales, ? esto va al final y en la funcion especificar el valor 
defecto */

Route::get('/holamundo', function($nombre = 'Jonh Lenn Kin'){
    return 'Hola '.$nombre;
});

//  No tiene valor de retorno 
Route:: get('letras/{name}', function($name){  
}) ->where ('name', '[A-Za-z]+');//para recibir solo letras
//Para recibir solo numeros '[0-9]+'


// Creacion de grupos de rutas
 /*Route:: group(['middleware' => 'auth'], function(){// este middleware se aplica a todo el grupo
     Route::get('/', function()
     {
         
     });
 });*/

/*Grupos- prefijos
/admin/users
*/
 Route:: group(['prefix' => 'admin'], function(){
    Route::get('users', function()
    {
        return 'Esta es con prefijo';
        // matches the "/admin/users" URL ya no se tiene que cambiar la ruta 
    });
});
\

// UTILIZANDO CONTROLADORES

/* El controlador es userControler y dentro de 
esa esta la funcion show la @ divide
No existe el controlador UserController*/
Route::get('user/{id}', 'UserController@show');//Por cada modelo un controlador 
Route::get('user/{id}', 'UserController@show')->middleware ('auth');// el middleware se aplica solo a este 


/*Aqui lo que le decimos es que vaya al controllador
HolaController y busque la funcion holaMundo 
*/
Route:: get('/hola/{nombres}', 'HolaController@holaMundo');
Route:: get('/nom/{name}', 'HolaController@hola');
Route:: get('/usuario/{id}','HolaController@usuario');


// En esta ruta estan los ciclos
Route:: get('/holapeople', 'HolaController@otra');
// En esta ruta estan las tablas
// Tabla del 1, 2, 3, 4, 99...
Route:: get('/tablas/{numero}', 'HolaController@tablas');

// Ejercicio numero divisor
Route:: get('/ejercicio','HolaController@ejercicio1');
Route:: post('/ejercicio', 'HolaController@respuesta');

// Ejercicio suma de dos numeros
Route:: get('/suma', 'OperacionesController@mostrarFormulario');
Route:: post('/suma', 'OperacionesController@sumar');


Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();


Route::get('/alumnos', 'AlumnoController@index');

//En esta ruta al final le decimos que
Route:: get('/alumnos/{id}','AlumnoController@show')->where('id', '[0-9]+')->name('alumno.ver');
Route:: get('/alumnos/crear','AlumnoController@create')->name('alumno.crear');
Route:: post('/alumnos/crear','AlumnoController@store')->name('alumno.guardar');

Route:: get('/alumnos/eliminar/{id}','AlumnoController@eliminar')->where('id', '[0-9]+')->name('alumno.eliminar');