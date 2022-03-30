<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

=======
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $mesas =Mesa::where('estado', '=', 'DISPONIBLE');

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
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesa $mesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesa $mesa)
=======
    public function vista_mesas()
    {
        return view('');
    }
    public function index(Request $request)
    {
        $mesas=Mesas::all();
        return $mesas;
    }
    public function estado_mesa(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id_mesa);
        $mesa->estado='RESERVADO';
        $mesa->update();
    }
    public function store(Request $request)
    {
        $mesa = new Mesa();
        $mesa->num_mesa=$request['num_mesa'];
        $mesa->estado = 'DISPONIBLE';
        $mesa->save();
    }
    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $mesa = Mesa::findOrFail($request->id_mesa);
        $mesa->num_mesa = $request['num_mesa'];
        $mesa->estado = $request['estado'];
        $mesa->update();
    }
    public function destroy($id)
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4
    {
        //
    }
}
