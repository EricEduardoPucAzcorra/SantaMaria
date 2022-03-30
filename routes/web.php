<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaObjetoController;
use App\Http\Controllers\ObjetoAlmacenController;
use App\Http\Controllers\UsuarioController;

//middlewares de usuarios no auteticados
Route::group(['middleware'=>['guest']], function(){
    //rutas del login
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'vistalogin']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

});

//middlware de usuario auteticados
Route::middleware(['auth'])->group(function () {

    //grupo de rutas middleware de rol Administrador
    Route::middleware(['Administrador'])->group(function () {
    //ruta de vista principal
    Route::get('/inicio', function () {
        return view('sistema.principal');
    })->name('inicio');
    //Apis-rutas de habitaciones
    Route::get('/habitaciones', [App\Http\Controllers\HabitacionController::class,'index']);
    Route::post('/habitacion/registrar',[App\Http\Controllers\HabitacionController::class,'store']);
    Route::put('/habitacion/actualizar',[App\Http\Controllers\HabitacionController::class,'update']);
    //Rutas de tipo de habitaciones
    ROute::get('/tipos_habitaciones', [App\Http\Controllers\TipoHabitacionController::class,'index']);
    //Apis-rutas reservas
    Route::post('/reservars', [App\Http\Controllers\ReservaController::class,'reservar']);
    Route::put('/cambiarestado', [App\Http\Controllers\ReservaController::class, 'updateestadoh']);
    //Apis-rutas huespedes
    Route::get('/huespedes', [App\Http\Controllers\HuespedController::class,'index']);
    //Apis-rutas categorias-objetos
    Route::get('/categoria_objetos', [App\Http\Controllers\CategoriaObjetoController::class, 'index']);
    Route::post('/categoria_objetos/registrar', [App\Http\Controllers\CategoriaObjetoController::class, 'store']);
    Route::put('/categoria_objetos/actualizar', [App\Http\Controllers\CategoriaObjetoController::class, 'update']);
    Route::put('/categoria_objetos/activar', [App\Http\Controllers\CategoriaObjetoController::class, 'activar']);
    Route::put('/categoria_objetos/desactivar', [App\Http\Controllers\CategoriaObjetoController::class, 'desactivar']);
    Route::get('/select_cat', [App\Http\Controllers\CategoriaObjetoController::class, 'select_cat']);
    //Apis-rutas objetos
    Route::get('/objetos_almacen', [App\Http\Controllers\ObjetoAlmacenController::class, 'index']);
    Route::post('/objetos_almacen/registrar', [App\Http\Controllers\ObjetoAlmacenController::class, 'store']);
    Route::put('/objetos_almacen/actualizar', [App\Http\Controllers\ObjetoAlmacenController::class, 'update']);
    Route::put('/objetos_almacen/activar', [App\Http\Controllers\ObjetoAlmacenController::class, 'activar']);
    Route::put('/objetos_almacen/desactivar', [App\Http\Controllers\ObjetoAlmacenController::class, 'desactivar']);
    //fin session almancen
    //Apis-enrutamiento de usuario
    Route::get('/usuarios',[App\Http\Controllers\UsuarioController::class,'index']);
    Route::get('/get_usuarios',[App\Http\Controllers\UsuarioController::class,'traerUsuarios']);
    //fin de enrutamiento de usuario

    //rutas del modulo Mesa
    Route::get('/mesas',[App\Http\COntrollers\MesaController::class,'index']);
    //ruta cerrar sessions

    Route::post('/salir', [App\Http\Controllers\Auth\LoginController::class, 'salir'])->name('salir');
    });
    //grupo de rutas middleware de rol Recepcionista
    Route::middleware(['Recepcionista'])->group(function () {
          //Apis-rutas reservas
        Route::post('/reservars', [App\Http\Controllers\ReservaController::class,'reservar']);
        Route::put('/cambiarestado', [App\Http\Controllers\ReservaController::class, 'updateestadoh']);
        //Apis-rutas huespedes
        Route::get('/huespedes', [App\Http\Controllers\HuespedController::class,'index']);
    });
    //grupo de rutas middleware de rol Mesero
    Route::middleware(['Mesero'])->group(function () {
     //rutas de comanda
      Route::get('/comidas', [App\Http\Controllers\ComandaController::class,'platillos']);
      Route::get('/refrescos', [App\Http\Controllers\ComandaController::class,'refrescos']);
      Route::get('/insertproduct',[App\Http\Controllers\ComandaController::class,'insertProducto']);
      //insert comand
      Route::post('create_comanda',[App\Http\Controllers\ComandaController::class,'createComandAndDetalis']);
    });
    //grupo de rutas middleware de rol Cocina
    Route::middleware(['Cocina'])->group(function () {
    //
    });

});


