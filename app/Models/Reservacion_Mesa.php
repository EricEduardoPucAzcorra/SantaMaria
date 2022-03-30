<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion_Mesa extends Model
{
    use HasFactory;
    protected $table = 'reservaciones_restaurante';
    protected $primaryKey = 'id_reservaR';
    public $incrementing = true;
    public $timestamps = true;
   // public $with=['mesas'];

    protected $fillable = [
        'fecha_reserva',
        'hora_reserva',
        'estado',
        'id_usuario'
    ];

    //una reserva solo admite varias mesas
    // public function mesas(){
    //     return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    // }

    public function user(){
        //una reserva lo realiza un huesped
      return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
