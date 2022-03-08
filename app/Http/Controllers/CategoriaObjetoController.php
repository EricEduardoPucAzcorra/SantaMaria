<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categoria_Objeto;

class CategoriaObjetoController extends Controller
{
    public function select_cat(){
        $cat_select = Categoria_Objeto::where('condicion', '=', '1')
        ->select('categoria_objetos.nombre','categoria_objetos.id_categoria_obj')
        ->orderBy('nombre', 'asc')->get();
        return $cat_select;
    }
    public function index(Request $request)
    {
        $criterio = $request->criterio;
        $buscar = $request->buscar;

        if($buscar==''){
            $categorias = Categoria_Objeto::orderBy('id_categoria_obj','DESC')->paginate(10);

        }else{
            $categorias = Categoria_Objeto::where($criterio, 'like','%' . $buscar . '%')
            ->orderBy('id_categoria_obj','DESC')->paginate(10);
        }

        //retornar propiedades
        return [
            'pagination' => [
                //propiedades de aginations
                'total'        => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page'     => $categorias->perPage(),
                'last_page'    => $categorias->lastPage(),
                'from'         => $categorias->firstItem(),
                'to'           => $categorias->lastItem(),
            ],
            'categorias'=> $categorias
        ];
    }

    public function store(Request $request)
    {
        $categoria = new Categoria_Objeto();
        $categoria->nombre = $request['nombre'];
        $categoria->descripcion = $request['descripcion'];
        $categoria->condicion = 1;
        $categoria->save();
    }

    public function update(Request $request)
    {
        $categoria = Categoria_Objeto::findOrFail($request->id_categoria_obj);
        $categoria->nombre = $request['nombre'];
        $categoria->descripcion = $request['descripcion'];
        $categoria->condicion = 1;
        $categoria->update();
    }


    public  function activar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $categoria = Categoria_Objeto::findOrFail($request->id_categoria_obj);
        $categoria->condicion = '1';
        $categoria->update();
    }

    public function desactivar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $categoria = Categoria_Objeto::findOrFail($request->id_categoria_obj);
        $categoria->condicion = '0';
        $categoria->update();
    }

}
