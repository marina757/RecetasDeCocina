<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //EVENTO QUE SE EJECUTA CUANDO UN USUARIO ES CREADO
    protected static function boot()
    {
        parent::boot();

        //ASIGNAR PERFIL UNA VEZ SE HAYA CREADO UN USUARIO NUEVO
        static::created(function ($user) {
            $user->perfil()->create();

        });
    }

    //RELACION 1:n DE USUARIO A RECETAS
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //RELACION 1:1 DE USUARIO Y PERFIL
    public function perfil() 
    {
        return $this->hasOne(Perfil::class);

    }
}
