<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Reservacion_Mesa extends Model
{
    use HasFactory;
    protected $table = 'detalle_reserva_restaurante';
    protected $primaryKey = 'id_detalle_reserva_restaurante';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'id_usuario',
        'id_mesa',
<<<<<<< HEAD
        'id_reservaR'
=======
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4

    ];

    public function reservaciones()
    {
        
       return $this->belongsTo(Reservacion_Mesa::class, 'id_reservaR', 'id_reservaR');
        
    }

<<<<<<< HEAD
    // public function mesa(){
    //     return $this->belongsTo(Habitacion::class, 'id_mesa', 'id_mesa');
    // }
=======
    public function mesa(){
        return $this->belongsTo(Habitacion::class, 'id_mesa', 'id_mesa');
    }
>>>>>>> 43616d0fae97d2611f72b22b92b30fdc9377eac4
}
