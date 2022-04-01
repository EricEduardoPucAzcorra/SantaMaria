<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Platillo extends Model
{
    use HasFactory;

    protected $table = 'categoria_platillos';
    protected $primaryKey = 'id_categoriaP';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

}
