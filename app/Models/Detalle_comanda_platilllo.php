<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_comanda_platilllo extends Model
{
    use HasFactory;

    protected $table = 'detalle_comanda_platillos';

    protected $primaryKey='id_detalle_comandaP';

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable=[
        'id_plato',
        'id_comanda',
        'cantidad_plato',
        'id_categoriaP',
        'importe',
        'subtotal',
        'total',
        'nota'
    ];

     public function comanda()
    {
        
       return $this->belongsTo(Comanda::class, 'id_comanda', 'id_comanda');
        
    }

    public function platillos(){
        return $this->belongsTo(Platillo::class, 'id_plato', 'id_plato');
    }

}
