<?php

namespace App\Http\Controllers;

use App\Models\Reservacion_Mesa;
use App\Models\Mesa;
use App\Models\User;
use App\Models\Detalle_Resrvacion_Mesa;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class ReservacionMesaController extends Controller
{
    public function usuarios()
    {
        $usuarios = User::all();
        return $usuarios;
    }
    public function reservar_mesa(Request $request)
    {
        try {
            DB::beginTransaction();
            if($request->input('id_usuario')!=0){
                //Creo reservacion de la mesa
                $reservacion_mesa = new Reservacion_Mesa();
                $reservacion_mesa->fecha_reserva = $request['fecha_reserva'];
                $reservacion_mesa->hora_reserva=$request['hora_reserva'];
                $reservacion_mesa->estado='ACEPTADO';
                $reservacion_mesa->id_usuario=$request['id_usuario'];
                $reservacion_mesa->id_mesa=$request['id_mesa'];
                $reservacion_mesa->save();
                //

                $fecha_reserva = $reservacion_mesa->fecha_reserva;
                $id_mesa=$reservacion_mesa->id_mesa;
                $id_usuario=$reservacion_mesa->id_usuario;

                $data = array('');

            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
