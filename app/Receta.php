<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //CAMPOS QUE SE AGREGARAN
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'
    ];

    //OBTIENE LA CATEGORIA DE LA RECETA VIA FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }
}
