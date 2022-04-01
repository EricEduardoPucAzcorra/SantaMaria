<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaObjetoController;
use App\Http\Controllers\ObjetoAlmacenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UserController;

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
    //roles
    Route::get('/select_rol', [App\Http\Controllers\RolController::class, 'select_rol']);
    //usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/registrar', [UserController::class, 'store']);
    Route::put('/users/actualizar', [UserController::class, 'update']);
    Route::put('/users/activar', [UserController::class, 'activar']);
    Route::put('/users/desactivar', [UserController::class, 'desactivar']);
    //fin de enrutamiento de usuario

    //rutas del modulo Mesa
    Route::get('/mesas',[App\Http\Controllers\MesaController::class,'index']);
    Route::get('/getmesas', [App\Http\Controllers\MesaController::class, 'index2']);
    Route::post('/mesa/registrar', [App\Http\Controllers\MesaController::class, 'store']);
    Route::put('/mesa/actualizar', [App\Http\Controllers\MesaController::class, 'update']);
    // Route::put('/mesa/activar', [App\Http\Controllers\MesaController::class, 'activar']);
    // Route::put('/mesa/desactivar', [App\Http\Controllers\MesaController::class, 'desactivar']);

    //ruta de las categorias de los producto 
    Route::get('/categoria_platillos', [App\Http\Controllers\Categoria_platillosController::class, 'index']);
    Route::post('/categoria_platillos/registrar', [App\Http\Controllers\Categoria_platillosController::class, 'store']);
    Route::put('/categoria_platillos/actualizar', [App\Http\Controllers\Categoria_platillosController::class, 'update']);
    Route::put('/categoria_platillos/activar', [App\Http\Controllers\Categoria_platillosController::class, 'activar']);
    Route::put('/categoria_platillos/desactivar', [App\Http\Controllers\Categoria_platillosController::class, 'desactivar']);
    Route::get('/select_catp', [App\Http\Controllers\Categoria_platillosController::class, 'select_catp']);
   //ruta de los productos o platillos 
   
  Route::get('/platillos',[App\Http\Controllers\PlatilloController::class,'index']);
  Route::post('/platillos/registrar',[App\Http\Controllers\PlatilloController::class,'store']);
  // Route::get('/platillos',[App\Http\Controllers\PlatilloController::class,'show']);
  Route::put('/platillos/actualizar',[App\Http\Controllers\PlatilloController::class,'update']);
  Route::put('/platillos/activar', [App\Http\Controllers\PlatilloController::class, 'activar']);
  Route::put('/platillos/desactivar', [App\Http\Controllers\PlatilloController::class, 'desactivar']);
   
   
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
     //rutas del modulo Mesa
     Route::get('/mesas',[App\Http\Controllers\MesaController::class,'index']);
      //rutas de productos
      Route::get('/productos', [App\Http\Controllers\ComandaController::class,'index']);
      Route::get('/comidas', [App\Http\Controllers\ComandaController::class,'platillos']);
      Route::get('/refrescos', [App\Http\Controllers\ComandaController::class,'refrescos']);
      Route::get('/insertproduct',[App\Http\Controllers\ComandaController::class,'insertProducto']);
     //create comanda
      Route::post('create_comanda',[App\Http\Controllers\ComandaController::class,'createComandAndDetalis']);
    //   Ruta detalle comandas
      Route::get('/detalles_comandas', [App\Http\Controllers\DetalleComandaPlatillloController::class,'index']);
    });
    //grupo de rutas middleware de rol Cocina
    Route::middleware(['Cocina'])->group(function () {
    //
    });

});


