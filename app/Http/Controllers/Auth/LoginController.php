<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//clases de login
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function vistalogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        
         $this->validar($request);

        //verifico si condiciden credenciañes y el estatis de su accion actviado o desactivadp

        if(Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password, 'condicion'=>1])){
             return redirect()->route('inicio');
        }

        return back()->withErrors(['usuario' => trans('auth.failed')])->withInput(request(['usuario']));
    }


    protected function validar(Request $request){
        $this->validate($request,[
            'usuario' => 'required|string',
            'password'=>'required|string'
        ]);
    }

    //cerrar session

    public function salir(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');

    }
    
}
