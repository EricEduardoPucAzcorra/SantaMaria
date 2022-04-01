<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria_Platillo;

class Categoria_platillosController extends Controller
{
    public function vista_catPlatillo(){
        return view('sistema.almacen.categorias_platillos');
    }

    public function select_catP(){
        //input select
        $catP_select = Categoria_Platillo::where('estado', '=', '1')
                      ->orderBy('nombre', 'asc')->get();
        return $catP_select;
    }

    public function index(Request $request)
    {
        $criterio = $request->criterio;
        $buscar = $request->buscar;

        if($buscar==''){
            $categoriasp = Categoria_Platillo::orderBy('id_categoriaP','DESC')->paginate(10);

        }else{
            $categoriasp = Categoria_Platillo::where($criterio, 'like','%' . $buscar . '%')
            ->orderBy('id_categoriaP','DESC')->paginate(10);
        }

        //retornar propiedades
        return [
            'pagination' => [
                //propiedades de aginations
                'total'        => $categoriasp->total(),
                'current_page' => $categoriasp->currentPage(),
                'per_page'     => $categoriasp->perPage(),
                'last_page'    => $categoriasp->lastPage(),
                'from'         => $categoriasp->firstItem(),
                'to'           => $categoriasp->lastItem(),
            ],
            'categorias'=> $categoriasp
        ];
    }

    public function store(Request $request)
    {
        $categoriap = new Categoria_Platillo();

        $categoriap->nombre = $request['nombre'];
        $categoriap->descripcion = $request['descripcion'];
        $categoriap->estado = 1;
        $categoriap->save();
    }

    public function update(Request $request)
    {
        $categoria = Categoria_Platillo::findOrFail($request->id_categoriaP);
        $categoria->nombre = $request['nombre'];
        $categoria->descripcion = $request['descripcion'];
        $categoria->estado = 1;
        $categoria->update();
    }


    public  function activar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $categoria = Categoria_Platillo::findOrFail($request->id_categoriaP);
        $categoria->estado = '1';
        $categoria->update();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoria = Categoria_Platillo::findOrFail($request->id_categoriaP);
        $categoria->estado = '0';
        $categoria->update();
    }
}
