<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\Platillo;
use Illuminate\Http\Request;
use App\Models\Detalle_comanda_platilllo;
use Illuminate\Support\Facades\Auth;

class ComandaController extends Controller
{
    
    public function platillos()
    {
        
         $platillos = Platillo::where('id_categoriaP', '=', 2)->get();

         return $platillos;
    }

    public function refrescos(){
         $refrescos = Platillo::where('id_categoriaP', '=', 4)->get();
         return $refrescos;
    }


    public function insertProducto(Request $request){
        $platillo = Platillo::findOrFail($request->id_plato);
        return $platillo;
    }

    public function createComandAndDetalis(Request $request){
        //dd($request->all());
        //for($i = 0; $i<count($request))

        $array = $request->all();

        $comanda = new Comanda();
        $comanda->fecha_comanda = '2022-03-20';
        $comanda->estado = 'ACEPTADO';
        $comanda->descripcion = 'Null';
        $comanda->id_mesa = 1;
        $comanda->id_usuario = Auth::user()->id_usuario;
        $comanda->save();

        for($i = 0; $i<count($array); $i++){
            $d[]=[
                'id_plato' => $array[$i]['id_plato'],

            ];

            //dd($d);
            
        }

       //return $d;

       Detalle_comanda_platilllo::insert($d);

        //pat intelitens
    }

    public function index()
    {
        //

    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Comanda $comanda)
    {
        //
    }

   
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comanda $comanda)
    {
        //
    }
}
