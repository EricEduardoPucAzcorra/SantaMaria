<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Objeto extends Model
{
    use HasFactory;

    protected $table = 'categoria_objetos';
    protected $primaryKey = 'id_categoria_obj';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'condicion'
    ];

    //relacion con objetos

    public function objeto(){
        return $this->hasMany(Objeto_Almacen::class);
    }
}
