<?php

namespace App\Http\Controllers;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
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
    {
        //
    }
}
