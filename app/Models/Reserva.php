<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    
    protected $table = 'reservaciones';
    protected $primaryKey = 'id_reserva';
    public $incrementing = true;
    public $timestamps = true;
    public $with=['habitaciones'];

    protected $fillable = [
        'fecha_entrada',
        'fecha_salida',
        'comentario',
        'id_habitacion',
        'cant_habitacion',
        'estado',
        'id_huesped',
        'precio',
        'total'
    ];

    //una reserva solo admite varias habitacion
    public function habitaciones(){
        return $this->belongsTo(Habitacion::class, 'id_habitacion', 'id_habitacion');
    }

    public function huespedes(){
        //una reserva lo realiza un huesped
      return $this->belongsTo(Huesped::class, 'id_huesped', 'id_huesped');
    }

    // public function detalle_reserva(){

    //    return $this->belongsTo(Detalle_Reserva::class, 'id_reserva', 'id_reserva');
        
    // }
}
