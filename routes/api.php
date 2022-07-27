<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/acceso', 'App\Http\Controllers\Apilogin@acceso');

Route::get('/habitaciones', 'App\Http\Controllers\HabitacionController@index');

Route::get('platillos','App\Http\Controllers\PlatilloController@platillos');


Route::apiResource('/actUser', UsuarioAController::class);
// Route::post('/validar',[UsuarioAController::class, 'validar']);

Route::post('/validar', 'App\Http\Controllers\UsuarioAController@validar');