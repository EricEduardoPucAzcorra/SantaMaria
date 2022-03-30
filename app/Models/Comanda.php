<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    protected $table='comandas';

    protected $primaryKey='id_comanda';

    public $incrementing=true;

    public $timestamps=true;

    protected $fillable=[
        'folio_comanda',
        'fecha_comanda',
        'descuento',
        'estado',
        'descripcion',
        'id_mesa',
        'id_usuario'
    ];


    public function platillos(){

     
        return $this->belongsTo(Platillo::class);
      
        
    }

}
