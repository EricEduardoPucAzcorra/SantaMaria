<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Habitacion extends Model
{
    use HasFactory;

    protected $table = 'tipos_habitaciones';
    protected $primaryKey = 'id_tipo';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'tipo',
        'descripcion'
    ];

}

