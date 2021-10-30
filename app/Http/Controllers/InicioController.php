<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //OBTENER LAS RECETAS MAS NUEVAS
        $nuevas = Receta::latest()->limit(5)->get();

        return view('inicio.index', compact('nuevas'));
    }
}
