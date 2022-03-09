<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Reserva extends Model
{
    use HasFactory;

    protected $table = 'detalle_reservaciones';
    protected $primaryKey = 'id_detalle_reserva';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'fecha_registro',
        'id_habitacion',
        'id_reserva',
        'total',
    ];
}
