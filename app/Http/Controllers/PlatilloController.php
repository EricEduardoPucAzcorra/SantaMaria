<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{

    public function platillos(){
        
        $platillos=Platillo::all();

        return response()->json($platillos,200);
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $platillos=Platillo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $platillos=new Platillo();

        $platillos->folio=$request->get('folio');
        $platillos->nombre=$request->get('nombre');
        $platillos->descripcion=$request->get('descripcion');
        $platillos->id_categoriaP=$request->get('id_categoriaP');
        $platillos->precio=$request->get('precio');
        $platillos->estado=1;

        $platillos->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $platillos=Platillo::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $platillos=Platillo::findOrFail($request->id_plato);

        $platillos->folio=$request->get('folio');
        $platillos->nombre=$request->get('nombre');
        $platillos->descripcion=$request->get('descripcion');
        $platillos->id_categoriaP=$request->get('id_categoriaP');
        $platillos->precio=$request->get('precio');
        $platillos->estado=1;

        $platillos->update();
    }

    public  function activar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $platillos = Platillo::findOrFail($request->id_plato);
        $platillos->estado = 1;
        $platillos->update();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $platillos = Platillo::findOrFail($request->id_plato);
        $platillos->estado = 0;
        $platillos->update();
    }
}
