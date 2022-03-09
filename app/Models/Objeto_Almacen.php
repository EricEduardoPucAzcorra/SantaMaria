<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto_Almacen extends Model
{
    use HasFactory;

    protected $table = 'objetos_almacen';
    protected $primaryKey = 'id_objeto';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'stock',
        'id_categoria_obj',
        'condicion'
    ];

    public function categoria(){
        //un producto o articulo tiene una categoria
        return $this->belongsTo(Categoria_Objeto::class);

    }
}
