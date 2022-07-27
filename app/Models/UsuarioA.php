<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UsuarioA extends Model
{
    use HasFactory;
    protected $table='usuarios_a';

    //llave primaria
    protected $primaryKey='id_usuario';

    
    public $with=['roles'];//especificamos las relaciones de las ids

    public $Incrementing=true;// la clave primaria es numerica
    public $timestamps=true;  //se va a utilizar etiquetas de tiempo
    
    //lista de campos que van a consumir valor
    protected $fillable=[
        'id_usuario',
        'nombre',
        'apellido_p',
        'apelido_m',
        'usuario',
        'password',
        'imagen',
        'id_rol',
        'condicion',
        'telefono',
        'email'
              
    ];

    public function roles() // encarga de hacer la union o relacion
    {
        return $this->belongsTo(rol::class, 'id_rol');
    }

    //obtener imagen
    public function imagen() :Attribute
    {
        return new Attribute(
            get: function($value) {
                if($value != null) {
                    return $value;
                } else {
                    return 'sin_imagen.png';
                }
            }
        );
    }
}
