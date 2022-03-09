<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';
    protected $primaryKey = 'id_habitacion';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'folio',
        'num_habitacion',
        'precio',
        'caracteristicas',
        'num_piso',
        'num_personas',
        'estado',
        'id_tipo',
    ];


}
