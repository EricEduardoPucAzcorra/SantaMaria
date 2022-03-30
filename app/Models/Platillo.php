<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    use HasFactory;

    protected $table = 'platillos';

    protected $primaryKey='id_plato';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable=[
        'folio',
        'nombre',
        'descripcion',
        'id_categoriaP',
        'precio',
        'estado'
    ];


    public function comandas(){

       return $this->belongsTo(Comanda::class);
        
    }
}
