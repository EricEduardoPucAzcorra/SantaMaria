<?php

namespace App\Http\Controllers;

use App\Models\Detalle_comanda_platilllo;
use App\Models\Comanda;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DetalleComandaPlatillloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();

        $date = $date->format('Y-m-d');

        $id_user = Auth::user()->id_usuario;

        $historialComandas = Comanda::where('fecha_comanda', $date, 'and')->where('id_usuario',$id_user)
                            ->join('detalle_comanda_platillos', 'comandas.id_comanda', '=' , 'detalle_comanda_platillos.id_comanda')
                            ->join('mesas', 'comandas.id_mesa', '=', 'mesas.id_mesa')
                            ->join('platillos', 'detalle_comanda_platillos.id_plato', '=' , 'platillos.id_plato')
                            ->select('comandas.id_comanda','comandas.fecha_comanda', 'comandas.estado', 'comandas.descripcion', 'mesas.num_mesa', 'platillos.folio', 'platillos.nombre as nombre_producto',
                            'detalle_comanda_platillos.cantidad_plato', 'detalle_comanda_platillos.total')
                            ->get();
        return $historialComandas;
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
     * @param  \App\Models\Detalle_comanda_platilllo  $detalle_comanda_platilllo
     * @return \Illuminate\Http\Response
     */
    public function show(Detalle_comanda_platilllo $detalle_comanda_platilllo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle_comanda_platilllo  $detalle_comanda_platilllo
     * @return \Illuminate\Http\Response
     */
    public function edit(Detalle_comanda_platilllo $detalle_comanda_platilllo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle_comanda_platilllo  $detalle_comanda_platilllo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalle_comanda_platilllo $detalle_comanda_platilllo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle_comanda_platilllo  $detalle_comanda_platilllo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detalle_comanda_platilllo $detalle_comanda_platilllo)
    {
        //
    }
}
