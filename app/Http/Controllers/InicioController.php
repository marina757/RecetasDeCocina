<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //OBTENER LAS RECETAS MAS NUEVAS
        $nuevas = Receta::latest()->limit(5)->get();

        //OBTENER TODAS LAS CATEGORIAS
        $categorias = CategoriaReceta::all();
        //return $categorias;
        
        //AGRUPAR LAS RECETAS POR CATEGORIA
        $recetas = [];

        foreach ($categorias as $categoria) {
         $recetas[ Str::slug( $categoria->nombre )] [] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        // return $recetas;

        return view('inicio.index', compact('nuevas', 'recetas'));
    }
}
