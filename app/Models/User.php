<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='users';

    protected $primaryKey='id_usuario';

    public $timestamps=false;

    public $with=['rol'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'usuario',
        'password',
        'imagen',
        'condicion',
        'id_rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relacion  usuario solamente tiene un rol
    public function rol()
    {
        # code...
        return $this->belongsTo(Rol::class, 'id_rol','id_rol');
    }

    //un usuario solo tiene un perfil de persona
    public function persona()
    {
        # code...
        return $this->belongsTo(Persona::class);
    }
}
