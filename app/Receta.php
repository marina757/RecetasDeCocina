<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //OBTIENE LA CATEGORIA DE LA RECETA VIA FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }
}
