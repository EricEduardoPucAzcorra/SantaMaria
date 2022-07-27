<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/acceso', 'App\Http\Controllers\Apilogin@acceso');

Route::get('/us', 'App\Http\Controllers\UsuarioAController@index');

Route::get('platillos','App\Http\Controllers\PlatilloController@platillos');
Route::get('getCategorias','App\Http\Controllers\Categoria_PlatillosController@categorias');

Route::apiResource('/actUser', UsuarioAController::class);
// Route::post('/validar',[UsuarioAController::class, 'validar']);

Route::post('/validar', 'App\Http\Controllers\UsuarioAController@validar');