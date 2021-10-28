<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //RELACION 1:1 DE PERFIL CON USUARIO
    public function usuario()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
