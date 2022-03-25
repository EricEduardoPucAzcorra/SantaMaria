<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaObjetoController;
use App\Http\Controllers\ObjetoAlmacenController;
use App\Http\Controllers\UsuarioController;



//rutas del login
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'vistalogin']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
//ruta cerrar session
Route::post('/salir', [App\Http\Controllers\Auth\LoginController::class, 'salir'])->name('salir');
//ruta de vista principal
Route::get('/inicio', function () {
    return view('sistema.principal');
})->name('inicio');

//rutas de habitaciones
Route::get('/h_habitaciones', [App\Http\Controllers\HabitacionController::class,'vista_habitaciones'])->name('h_habitaciones');
Route::get('/habitaciones', [App\Http\Controllers\HabitacionController::class,'index']);
Route::post('/habitacion/registrar',[App\Http\Controllers\HabitacionController::class,'store']);
Route::put('/habitacion/actualizar',[App\Http\Controllers\HabitacionController::class,'update']);
//Rutas de tipo de habitaciones
ROute::get('/tipos_habitaciones', [App\Http\Controllers\TipoHabitacionController::class,'index']);
//rutas reservas
Route::get('/reservar', function(){
  return view('sistema.admin.hotel.reservaciones.reservar');
})->name('reservar');
//rutas detalles_reserva
Route::get('detalle_reservas', function(){
  return view('sistema.admin.hotel.reservaciones.detalle_reservas');
});
Route::post('/reservars', [App\Http\Controllers\ReservaController::class,'reservar']);
Route::put('/cambiarestado', [App\Http\Controllers\ReservaController::class, 'updateestadoh']);
//rutas huespedes
Route::get('/huespedes', [App\Http\Controllers\HuespedController::class,'index']);
//rutas categorias-objetos
Route::get('/categoria_objs', [App\Http\Controllers\CategoriaObjetoController::class, 'vista_catObj']);
Route::get('/categoria_objetos', [App\Http\Controllers\CategoriaObjetoController::class, 'index']);
Route::post('/categoria_objetos/registrar', [App\Http\Controllers\CategoriaObjetoController::class, 'store']);
Route::put('/categoria_objetos/actualizar', [App\Http\Controllers\CategoriaObjetoController::class, 'update']);
Route::put('/categoria_objetos/activar', [App\Http\Controllers\CategoriaObjetoController::class, 'activar']);
Route::put('/categoria_objetos/desactivar', [App\Http\Controllers\CategoriaObjetoController::class, 'desactivar']);
Route::get('/select_cat', [App\Http\Controllers\CategoriaObjetoController::class, 'select_cat']);
//rutas objetos
Route::get('/almacen',[App\Http\Controllers\ObjetoAlmacenController::class, 'vistaAlmacen'])->name('almacen');
Route::get('/objetos_almacen', [App\Http\Controllers\ObjetoAlmacenController::class, 'index']);
Route::post('/objetos_almacen/registrar', [App\Http\Controllers\ObjetoAlmacenController::class, 'store']);
Route::put('/objetos_almacen/actualizar', [App\Http\Controllers\ObjetoAlmacenController::class, 'update']);
Route::put('/objetos_almacen/activar', [App\Http\Controllers\ObjetoAlmacenController::class, 'activar']);
Route::put('/objetos_almacen/desactivar', [App\Http\Controllers\ObjetoAlmacenController::class, 'desactivar']);
//fin session almancen

//enrutamiento de usuario
Route::get('/usuarios',[App\Http\Controllers\UsuarioController::class,'index']);
Route::get('/get_usuarios',[App\Http\Controllers\UsuarioController::class,'traerUsuarios']);
//fin de enrutamiento de usuario

// Route::get('users', function() {
//     //
//   return App\Models\User::all();
// });