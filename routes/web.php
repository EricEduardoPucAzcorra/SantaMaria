<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaObjetoController;
use App\Http\Controllers\ObjetoAlmacenController;

Route::get('/', function () {
    return view('Bienvenido');
});

Route::get('index', function () {
    return view('index');
});

//rutas categorias-objetos
Route::get('/categoria_objetos', [App\Http\Controllers\CategoriaObjetoController::class, 'index']);
Route::post('/categoria_objetos/registrar', [App\Http\Controllers\CategoriaObjetoController::class, 'store']);
Route::put('/categoria_objetos/actualizar', [App\Http\Controllers\CategoriaObjetoController::class, 'update']);
Route::put('/categoria_objetos/activar', [App\Http\Controllers\CategoriaObjetoController::class, 'activar']);
Route::put('/categoria_objetos/desactivar', [App\Http\Controllers\CategoriaObjetoController::class, 'desactivar']);
Route::get('/select_cat', [App\Http\Controllers\CategoriaObjetoController::class, 'select_cat']);
//rutas objetos
Route::get('/almacen', function(){
    return view('sistema.almacen.almacen');
});
Route::get('/objetos_almacen', [App\Http\Controllers\ObjetoAlmacenController::class, 'index']);
Route::post('/objetos_almacen/registrar', [App\Http\Controllers\ObjetoAlmacenController::class, 'store']);
Route::put('/objetos_almacen/actualizar', [App\Http\Controllers\ObjetoAlmacenController::class, 'update']);
Route::put('/objetos_almacen/activar', [App\Http\Controllers\ObjetoAlmacenController::class, 'activar']);
Route::put('/objetos_almacen/desactivar', [App\Http\Controllers\ObjetoAlmacenController::class, 'desactivar']);