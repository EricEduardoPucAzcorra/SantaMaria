<?php

namespace App\Http\Controllers;

use App\Models\Objeto_Almacen;
use Illuminate\Http\Request;

class ObjetoAlmacenController extends Controller
{
    public function vistaAlmacen(){
        return view('sistema.almacen.almacen');
    }
    
    public function index(Request $request)
    {
        $criterio = $request->criterio;
        $buscar = $request->buscar;

        if($buscar==''){
            //lo relaciono con la tabla de categorias, diciendole que la id categoria de la tabla objetos sera igual a la id de la tabla categorias
            $objetos = Objeto_Almacen::join('categoria_objetos', 'objetos_almacen.id_categoria_obj', '=', 'categoria_objetos.id_categoria_obj')
            ->select('objetos_almacen.id_objeto','objetos_almacen.nombre', 'objetos_almacen.descripcion', 'objetos_almacen.cantidad', 'objetos_almacen.stock', 'objetos_almacen.condicion',
            'categoria_objetos.nombre as nombre_categoria','categoria_objetos.id_categoria_obj')
            ->orderBy('id_objeto','DESC')->paginate(10);

        }else{
            $objetos = Objeto_Almacen::join('categoria_objetos', 'objetos_almacen.id_categoria_obj', '=', 'categoria_objetos.id_categoria_obj')
            ->select('objetos_almacen.id_objeto','objetos_almacen.nombre', 'objetos_almacen.descripcion', 'objetos_almacen.cantidad', 'objetos_almacen.condicion',
            'objetos_almacen.stock','categoria_objetos.nombre as nombre_categoria','categoria_objetos.id_categoria_obj')
            ->where('objetos_almacen.'.$criterio, 'like','%' . $buscar . '%')
             ->orderBy('objetos_almacen.id_objeto','DESC')->paginate(10);
        }

        //retornar propiedades
        return [
            'pagination' => [
                //propiedades de aginations
                'total'        => $objetos->total(),
                'current_page' => $objetos->currentPage(),
                'per_page'     => $objetos->perPage(),
                'last_page'    => $objetos->lastPage(),
                'from'         => $objetos->firstItem(),
                'to'           => $objetos->lastItem(),
            ],
            'objetos'=> $objetos
        ];
    }

    

    public function store(Request $request)
    {
       
        $objeto_almacen = new Objeto_Almacen();
        $objeto_almacen->nombre = $request['nombre'];
        $objeto_almacen->descripcion = $request['descripcion'];
        $objeto_almacen->cantidad = $request['cantidad'];
        $objeto_almacen->stock = $request['stock']; 
        $objeto_almacen->id_categoria_obj = $request['id_categoria_obj']; 
        $objeto_almacen->condicion = 1;
        $objeto_almacen->save();
    }

   
    public function update(Request $request)
    {
        //busco
        $objeto_almacen = Objeto_Almacen::findOrFail($request->id_objeto);
        //actualizo
        $objeto_almacen->nombre = $request['nombre'];
        $objeto_almacen->descripcion = $request['descripcion'];
        $objeto_almacen->cantidad = $request['cantidad'];
        $objeto_almacen->stock = $request['stock']; 
        $objeto_almacen->id_categoria_obj = $request['id_categoria_obj']; 
        $objeto_almacen->condicion = 1;
        $objeto_almacen->update();
    }

    public function activar(Request $request)
    {
        //busco
        $objeto_almacen = Objeto_Almacen::findOrFail($request->id_objeto);
        $objeto_almacen->condicion = 1;
        $objeto_almacen->update();
    }

    public function desactivar(Request $request)
    {
        //busco
        $objeto_almacen = Objeto_Almacen::findOrFail($request->id_objeto);
        $objeto_almacen->condicion = 0;
        $objeto_almacen->update();
    }


}
