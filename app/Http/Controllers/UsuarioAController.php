<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioA;

class UsuarioAController extends Controller
{
    public function index()
    {
        $usuarios=UsuarioA::all();
        return response()->json($usuarios,200);

    }

       /**
     * Validar que usuario y contraseña estén en la BD
     * @param Request $request recibe los parámetros dentro la petición post.
     */
    public function validar(Request $request) {
        $respuesta="";
        $filtro = UsuarioA::where('usuario', $request->usuario)->where('password', $request->password)->get()->first();
        $respuesta = response()->json([$filtro], 200);
       
       return $respuesta;
    }

}
