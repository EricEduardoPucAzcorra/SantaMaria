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
    public $with =['tipo_habitaciones'];
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

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public function tipo_habitaciones(){
        return $this->belongsTo(Tipo_Habitacion::class, 'id_tipo','id_tipo');
    }

}
