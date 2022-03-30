<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('sistema.usuarios.usuarios');
    }
    public function traerUsuarios()
    {
        $usuarios = User::all();
        return $usuarios;
    }
    
    public function store(Request $request)
    {
        //
        $usuario = new User();
        $usuario->usuario=$request['usuario'];
        $usuario->condicion=1;
        $usuario->id_rol=$request['id_rol'];

        $usuario->password=Hash::make($request['password']);
        $usuario->save();
    }

    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
        $usuario = User::findOrFail($request->id_user);
        $usuario->usuario=$request['usuario'];
        $usuario->condicion=$request['codicion'];
        $usuario->id_rol=$request['id_rol'];
        $usuario->update();
    }
 
    public function destroy($id)
    {
        //
    }
}
