<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

    //regreso a la vista inicio de sesion
    Route::group(["middleware"=>"auth"],function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    //ruta para ver la vista home o vista principal
    Route::get('/home', 'HomeController@index')->name('home');

    //rutas para retornar las vistas de los items del menu
    Route::get("/estudiantes",function (){
        return view("estudiantes");
    });
    Route::get("/docentes",function (){
        return view("docentes");
    });
    Route::get("/particulares",function (){
        return view("particulares");
    });
    Route::get("/estadisticas",function (){
        return view("estadisticas");
    });

    Route::get("/pagosp",function (){
        return view("pagosparticulares");
    });

    //ruta para retornar la vista del perfil
    Route::get("/perfil",function (){
        return view("perfil");
    });

    //ruta para retornar la vista medidas antropometricas
    Route::get("/imc",function (){
        return view("imc");
    });
    //ruta para retornar la vista de estadisticas
    Route::get("/verestadistica",function (){
        return view("verestadistica");
    });
    //ruta para retornar la vista de grasa
    Route::get("/grasa",function (){
        return view("grasa");
    });
    //ruta para retornar la vista de riffier
    Route::get("/ruffiel",function (){
        return view("ruffiel");
    });
    //ruta para retornar la vista de formulario de medidas antropometricas
    Route::get("/botonimc",function (){
        return view("botonimc");
    });
    //ruta para retornar la vista de formulario de grasa
    Route::get("/botongrasa",function (){
        return view("botongrasa");
    });
    //ruta para retornar la vista de formulario de ruffier
    Route::get("/botonruffier",function (){
        return view("botonruffier");
    });
    //RUTAS PARA GRAFICOS
    // ruta para ver graficos
    Route::get('/grafico/{id}/mostrar','GraficoController@index')->name('grafico.mostrar');

    //RUTAS PARA USUARIO
    // ruta crear un nuevo usuario
    Route::post('/nuevousuario','AuthController@crear_usuario')->name('nuevo.usuario');
    // ruta para retornar la vista de autenticacion de un usuario
    Route::get('/perfil','AuthController@index')->name('usuarios');
    // ruta para borrar un usuario
    Route::delete('usuario/borrar','AuthController@destroy')->name('usuario.borrar');
    //ruta para crear un usuario
    Route::post('/perfil','AuthController@crear_usuario')->name('nuevo.usuario');
    //ruta para ver la vista de usuarios
    Route::get('/perfil','AuthController@index');

    //RUTAS PARA LOS ESTUDIANTES
    //ruta para ver la vista de estudiantes
    Route::get('estudiantes/', 'EstudiantesController@index')->name('estudiantes');
    //ruta para crear un estudiante
    Route::get('estudiantes/crear/{id}', 'EstudiantesController@create')->name('estudiantes.formulario');
    //ruta para guardar un estudiante
    Route::post('estudiantes/guardar', 'EstudiantesController@store')->name('estudiante.guardar');
    //ruta para borrar un estudiante
    Route::delete('estudiantes/borrar','EstudiantesController@destroy')->name('estudiante.borrar');
    //ruta para editar un estudiante
    Route::get('estudiantes/{id}/editar','EstudiantesController@edit')->name('estudiante.editar');
    //ruta para actualizar un estudiante
    Route::put('estudiantes/editar','EstudiantesController@update')->name('estudiante.update');
    //ruta para buscar un estudiante
    Route::get("buscarEstudiante","EstudiantesController@buscarEstudiante")->name("estudiante.buscarEstudiante");

    //RUTAS PARA PAGOS ESTUDIANTES
    //ruta para ver la vista de pagos estudiantes
    Route::get('pagosestudiantes/{id}', 'PagoEstudianteController@index')->name('pagoestudiantes');
    //ruta para crear un estudiantes
    Route::get('pagosestudiantes/crear', 'PagoEstudianteController@create')->name('pagoestudiantes.formulario');
    //ruta para guardar un estudiantes
    Route::post('pagosestudiantes/guardar', 'PagoEstudianteController@store')->name('pagoestudiantes.guardar');
    //ruta para borrar un estudiantes
    Route::delete('pagosestudiantes/borrar','PagoEstudianteController@destroy')->name('pagoestudiante.borrar');
    //ruta para editar un estudiantes
    Route::get('pagosestudiantes/{id}/editar','PagoEstudianteController@edit')->name('pagoestudiantes.editar');
    //ruta para actualizar un estudiantes
    Route::put('pagosestudiantes/editar','PagoEstudianteController@update')->name('pagoestudiantes.update');
    //ruta para buscar un pago en estudiantes
    Route::get("buscarPago","PagoEstudianteController@buscarPagos")->name("pagosestudiantes.buscarPago");

    //RUTAS PARA DOCENTES
    //ruta para ver la vista de docentes
    Route::get('docentes/', 'DocentesController@index')->name('docentes');
    //ruta para crear un docente
    Route::get('docentes/crear', 'DocentesController@create')->name('docentes.formulario');
    //ruta para guardar un de docente
    Route::post('docentes/guardar', 'DocentesController@store')->name('docente.guardar');
    //ruta para borrar un docente
    Route::delete('docentes/borrar','DocentesController@destroy')->name('docente.borrar');
    //ruta para editar un docente
    Route::get('docentes/{id}/editar','DocentesController@edit')->name('docente.editar');
    //ruta para actualizar un docente
    Route::put('docentes/editar','DocentesController@update')->name('docente.update');
    //ruta para buscar un docente
    Route::get("buscarDocente","DocentesController@buscarDocente")->name("docente.buscarDocente");

    //RUTAS PARA LOS PARTICULARES
    //ruta para ver la vista de particulares
    Route::get('particulares/', 'ParticularesController@index')->name('particulares');
    //ruta para crear un particular
    Route::get('particulares/crear', 'ParticularesController@create')->name('particulares.formulario');
    //ruta para guardar un particular
    Route::post('particulares/guardar', 'ParticularesController@store')->name('particular.guardar');
    //ruta para borrar un particular
    Route::delete('particulares/borrar','ParticularesController@destroy')->name('particular.borrar');
    //ruta para editar un particular
    Route::get('particulares/{id}/editar','ParticularesController@edit')->name('particular.editar');
    //ruta para actualizar un particular
    Route::put('particulares/editar','ParticularesController@update')->name('particular.update');

    //RUTAS PARA PAGOS PARTICULARES
    //ruta para ver la vista de pagos particulares
    Route::get('pagosparticulares/{id}', 'PagoParticularController@index')->name('pagoparticulares');
    //ruta para crear un pago particular
    Route::get('pagosparticulares/crear', 'PagoParticularController@create')->name('pagoparticulares.formulario');
    //ruta para guardar un pago particular
    Route::post('pagosparticulares/guardar', 'PagoParticularController@store')->name('pagoparticulares.guardar');
    //ruta para borrar un pago particular
    Route::delete('pagosparticulares/borrar', 'PagoParticularController@destroy')->name('pagoparticulares.borrar');
    //ruta para editar un pago particular
    Route::put('pagosparticulares/editar','PagoParticularController@update')->name('pagoparticulares.update');
    //ruta para buscar un particular
    Route::get("buscarParticular","ParticularesController@buscarParticular")->name("particular.buscarParticular");


    //RUTAS PARA ESTADISTICAS
    //ruta para mostrar la vista de estadisticas
    Route::get('estadisticas/', 'EstadisticasController@index')->name('estadisticas');
    //ruta para estadisticas(expendientes del cliente)
    Route::get('estadisticas/crear', 'EstadisticasController@create')->name('estadisticas.crear');
    Route::get("estadisticas/{id}","EstadisticasController@show")->name("estadistica.ver");
    Route::delete("pago/borrar","EstadisticasController@borrarPagoEstadistica")->name("pago.estadistica.borrar");
    Route::delete("grasa/estadistica/borrar","EstadisticasController@borrarGrasaEstadistica")->name("grasa.estadistica.borrar");
    Route::delete("imc/estadistica/borrar","EstadisticasController@borrarImcEstadistica")->name("imc.estadistica.borrar");
    Route::delete("ruffier/estadistica/borrar","EstadisticasController@borrarRuffierEstadistica")->name("ruffier.estadistica.borrar");
    //ruta para buscar un cliente
    Route::get("buscarCliente","EstadisticasController@buscarCliente")->name("cliente.buscarCliente");



    //RUTAS PARA GRASA CORPORAL
    //ruta para ver la vista de grasa corporal
    Route::get('cliente/grasa/{id_grasa}/index', 'GrasaController@index')->name('grasa.uni');
    //ruta para crear una nuevo elemento de  grasa corporal
    Route::get('cliente/grasa/{id}/nuevo', 'GrasaController@Create')->name('botongrasa');
    //ruta para guardar una nueva medida grasa corporal
    Route::post('cliente/grasa/crear', 'GrasaController@store')->name('grasa.guardar');
    //ruta para borrar un elemento de grasa corporal
    Route::delete('grasa/borrar','GrasaController@destroy')->name('grasa.borrar');
    //ruta para editar un elemento de grasa corporal
    Route::get('cliente/{id_cliente}/grasa/{id_grasa}/editar','GrasaController@edit')->name('grasa.editar');
    //ruta para actualizar un elemento de grasa corporal
    Route::put('cliente/grasa/{id}/edit','GrasaController@update')->name('grasa.update');

    //RUTAS PARA RUFFIER
    //ruta para ver la vista index
    Route::get('cliente/ruffier/{id}/index', 'RuffierController@index')->name('ruffier.uni');
    //ruta para crear un nuevo elemento en ruffier
    Route::get('cliente/ruffier/{id}/nuevo', 'RuffierController@Create')->name('botonruffier');
    //ruta para guardar un elemento en ruffier
    Route::post('cliente/ruffier/crear', 'RuffierController@store')->name('ruffier.guardar');
    //ruta para borrar un elemento de ruffier
    Route::delete('ruffier/borrar','RuffierController@destroy')->name('ruffier.borrar');
    //ruta para editar un elemento de ruffier
    Route::get('cliente/{id_cliente}/rufier/{id}/editar','RuffierController@edit')->name('ruffier.editar');
    //ruta para actualizar un elemento de ruffier
    Route::put('cliente/ruffier/{id}/edit','RuffierController@update')->name('ruffier.update');

    //RUTAS PARA MEDIDAS ANTROPOMETRICAS
    //ruta para ver la vista de medidas antropometricas
    Route::get('cliente/imc/{id}/index','ImcController@index')->name('imc.ini');
    //ruta para crear un nuevo elemento de medidas antropometricas
    Route::get('cliente/imc/{id}/nuevo','ImcController@create')->name('botonimc');
    //ruta para guardar un elemento de medidas antropometricas
    Route::post('cliente/imc/crear','ImcController@store')->name('imc.guardar');
    //ruta para borrar un elemento de medidas antropometricas
    Route::delete('imc/borrar','ImcController@destroy')->name('imc.borrar');
    //ruta para editar un elemento de medidas antropometricas
    Route::get('cliente/{id_cliente}/imc/{id}/editar','ImcController@edit')->name('imc.editar');
    //ruta para actualizar un elemento de medidas antropometricas
    Route::put('imc/{id}/edit','ImcController@update')->name('imc.update');
    //Route::get('imc/{id}/mostrar','ImcController@mostrarIMCCliente')->name('botomostrar');
    });
    //RUTAS PARA LAS CONTRASEÑAS
    // rutas para las contraseñas(autenticacion)
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name("password.request");
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name("password.email");
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name("password.reset");
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Auth::routes();

