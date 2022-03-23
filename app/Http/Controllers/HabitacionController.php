<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function vista_habitaciones(){
        return view('sistema.admin.hotel.habitaciones.habitaciones');
    }
    //retorna registros
    public function index(Request $request)
    {
        $habitaciones = Habitacion::all();
        return $habitaciones;
        
    }

     public function estado(Request $request)
    {
        $habitacion = Habitacion::findOrFail($request->id_habitacion);
        $habitacion->estado = 'OCUPADO';
        $habitacion->update();
    }

    
    public function store(Request $request)
    {
        //
        $habitacion = new Habitacion();
        $habitacion->folio = $request['folio'];
        $habitacion->num_habitacion = $request['num_habitacion'];
        $habitacion->precio = $request['precio'];
        $habitacion->caracteristicas = $request['caracteristicas'];
        $habitacion->num_piso = $request['num_piso'];
        $habitacion->num_personas = $request['num_personas'];
        $habitacion->estado = 'DISPONIBLE';
        $habitacion->id_tipo = $request['id_tipo'];
        $habitacion->save();

    }

    public function update(Request $request)
    {
        $habitacion = Habitacion::findOrFail($request->id_habitacion);
        $habitacion->folio = $request['folio'];
        $habitacion->num_habitacion = $request['num_habitacion'];
        $habitacion->precio = $request['precio'];
        $habitacion->caracteristicas = $request['caracteristicas'];
        $habitacion->num_piso = $request['num_piso'];
        $habitacion->num_personas = $request['num_personas'];
        $habitacion->estado = $request['estado'];
        $habitacion->id_tipo = $request['id_tipo'];
        $habitacion->update();
    }    
}
