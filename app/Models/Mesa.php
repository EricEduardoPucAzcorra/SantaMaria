<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $table = 'mesas';
    protected $primaryKey = 'id_mesa';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'num_mesa',
        'estado'
    ];

    public function reservaciones(){
        return $this->hasMany(Reservacion_Mesa::class);
    }
}
