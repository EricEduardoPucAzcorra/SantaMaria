<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\DB;

class Apilogin extends Controller
{
    
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/vista';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

    public function acceso(Request $request){

        if(Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])){ 
          $user = Auth::user();
          $username = $user->usuario;

          $status = 'success';
          return response()->json([
            'status'   => 'success',
            'user' => $username
          ]); 

           return redirect('http://santa-maria.test/vista');

        } else { 
          return response()->json([
            'status' => 'error',
            'user'   => 'rechazo Access'
          ]); 
        } 
        
        // $usuario = $request->usuario;

        // $password = $request->password;

        // $array = '';

        // $consulta = User::where('usuario', '=', $usuario, 'AND')
        //                 ->where('password','=', $password)->first();


        // if($consulta != null){

        //      $array = response()->json([$consulta, 200]);   
        
        // }else{

        //     $array = response()->json([$consulta, 400]); 

        // }

        // return $array;
            

    }

}
