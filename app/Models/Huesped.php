<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huesped extends Model
{
    use HasFactory;

    protected $table = 'huespedes';
    protected $primaryKey = 'id_huesped';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'apellidos',
        'ine',
        'telefono',
        'correo'
    ];
}
