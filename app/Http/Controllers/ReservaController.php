<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Huesped;
use App\Models\Habitacion;
use App\Models\Detalle_Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class ReservaController extends Controller
{
    private $estadoh;



    public function huespedes(){
        $huespedes = Huesped::all();
        return $huespedes;
    }
    public function reservar(Request $request){
        //
        try{
            //hagotransaccion
            DB::beginTransaction();
             //valido si campo es diferente de cero

            $date = Carbon::now();

            $date = $date->format('Y-m-d');


            if($request->input('id_huesped')!=0){

            //creo la reserva
                $reserva = new Reserva();
                $reserva->fecha_entrada = $request['fecha_entrada'];//viene de vista
                $reserva->fecha_salida = $request['fecha_salida'];//viene de vista
                $reserva->comentario = $request['comentario'];//viene de vista null
                $reserva->id_habitacion = $request['id_habitacion'];  //viene de vista
                $reserva->cant_habitacion = $request['cant_habitacion']; //viene de codigo js
                $reserva->estado = $request['estado']; //viene de controller 
                $reserva->id_huesped = $request['id_huesped'];
                //viene de vista
                $reserva->precio = $request['precio'];//viene de vista
                $reserva->total = $request['total']; //viene de vista
                $reserva->save();
            
                $fecha_entrada = $reserva->fecha_entrada;
                $id_habitacion = $reserva->id_habitacion;
                $id_reserva = $reserva->id_reserva;
                $total = $reserva->total;

                $data = array('fecha_registro' => $fecha_entrada, 'id_habitacion' => $id_habitacion, 'id_reserva' => $id_reserva, 'total' => $total);


                DB::table('detalle_reservaciones')->insert($data);
                
            }else{
                //creo huesped
                $huesped = new Huesped();
                $huesped->nombre = $request['nombre'];
                $huesped->apellidos = $request['apellidos'];
                $huesped->ine = $request['ine'];
                $huesped->telefono = $request['telefono'];
                $huesped->correo = $request['correo'];
                $huesped->save();
                //creo reserva
                $reserva = new Reserva();
                $reserva->fecha_entrada = $request['fecha_entrada'];//viene de vista
                $reserva->fecha_salida = $request['fecha_salida'];//viene de vista
                $reserva->comentario = $request['comentario'];//viene de vista null
                $reserva->id_habitacion = $request['id_habitacion'];  //viene de vista
                $reserva->cant_habitacion = $request['cant_habitacion']; //viene de codigo js
                $reserva->estado = $request['estado'];//viene de controller 
                $reserva->id_huesped = $huesped->id_huesped;
                //viene de vista
                $reserva->precio = $request['precio'];//viene de vista
                $reserva->total = $request['total']; //viene de vista
                $reserva->save();
                //variables se capturan desde los anteruores request
                $fecha_entrada = $reserva->fecha_entrada;
                $id_habitacion = $reserva->id_habitacion;
                $id_reserva = $reserva->id_reserva;
                $total = $reserva->total;

                $data = array('fecha_registro' => $fecha_entrada, 'id_habitacion' => $id_habitacion, 'id_reserva' => $id_reserva, 'total' => $total);

                DB::table('detalle_reservaciones')->insert($data);
            }

                // return $reserva->total;
  
        DB::commit();

        } catch(Exception $e){
            //muestro errors
            DB::rollBack();

             return 'La cita fue fallida';
        }
    }

    public function updateestadoh(Request $request)
    {
        $habitacion = Habitacion::findOrFail($request->id_habitacion);
        $habitacion->estado = $request['estado'];
        $habitacion->update();
    }
    
  

}
