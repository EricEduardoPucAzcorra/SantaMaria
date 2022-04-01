<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Reserva;
use Illuminate\Http\Request;

class DetalleReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalles = Detalle_Reserva::join('habitaciones', 'detalle_reservaciones.id_habitacion', '=', 'habitaciones.id_habitacion')
        ->join('tipos_habitaciones', 'habitaciones.id_tipo', '=', 'tipos_habitaciones.id_tipo')
        ->select('detalle_reservaciones.id_detalle_reserva','detalle_reservaciones.fecha_registro','detalle_reservaciones.id_reserva','habitaciones.folio as num_folio','habitaciones.num_habitacion','tipos_habitaciones.tipo as tipo_h','detalle_reservaciones.total')
        ->orderBy('id_detalle_reserva', 'desc')->get();

        return $detalles;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle_Reserva  $detalle_Reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Detalle_Reserva $detalle_Reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle_Reserva  $detalle_Reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Detalle_Reserva $detalle_Reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle_Reserva  $detalle_Reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalle_Reserva $detalle_Reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle_Reserva  $detalle_Reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detalle_Reserva $detalle_Reserva)
    {
        //
    }
}
