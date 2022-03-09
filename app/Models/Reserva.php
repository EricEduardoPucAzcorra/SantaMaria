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
}
