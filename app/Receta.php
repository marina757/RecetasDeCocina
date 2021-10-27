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

    //OBTIENE LA INFORMACION DEL USUARIO VIA FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');//FK de esta tabla
    }
}
