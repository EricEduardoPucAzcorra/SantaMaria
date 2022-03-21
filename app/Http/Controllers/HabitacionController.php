<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    //retorna registros
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Habitacion $habitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacion $habitacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion)
    {
        //
    }

     

}
