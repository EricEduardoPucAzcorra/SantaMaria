<?php

namespace App\Http\Controllers;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $mesas = Mesa::where('estado', '=', 'DISPONIBLE')->get();

        return $mesas;
    }

    public function index2(){
       return $mesas = Mesa::all();
    }

    
    public function store(Request $request)
    {
        $mesa = new Mesa();
        $mesa->num_mesa = $request['num_mesa'];
   
        $mesa->estado = $request['estado'];
     
        $mesa->save();
    }


    public function update(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id_mesa);
        $mesa->num_mesa = $request['num_mesa'];
        $mesa->estado = $request['estado'];
        $mesa->update();
    }

    public  function activar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $mesa = Mesa::findOrFail($request->id_mesa);
        $mesa->update();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $mesa = Mesa::findOrFail($request->id_mesa);
        $mesa->update();
    }

}
