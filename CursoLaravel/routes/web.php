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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/comidas","ComidasController@index");
Route::get("/nueva_comida","ComidasController@store")->name("nueva_comida");

Route::get("/buscar", "ComidasController@buscar")->name("buscar");

Route::get("/borrar", "ComidasController@destroy")->name("borrar");



