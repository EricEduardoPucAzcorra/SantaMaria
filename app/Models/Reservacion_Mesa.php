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
<<<<<<< HEAD
   // public $with=['mesas'];
=======
    public $with=['mesas'];
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4

    protected $fillable = [
        'fecha_reserva',
        'hora_reserva',
        'estado',
<<<<<<< HEAD
        'id_usuario'
    ];

    //una reserva solo admite varias mesas
    // public function mesas(){
    //     return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    // }

    public function user(){
        //una reserva lo realiza un huesped
      return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
=======
        'id_usuario',
        'id_mesa'
    ];

    //una reserva solo admite varias mesas
    public function mesas(){
        return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    }

    public function personas(){
        //una reserva lo realiza un huesped
      return $this->belongsTo(Persona::class, 'id_usuario', 'id_usuario');
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4
    }
}
