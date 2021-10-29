<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
         //ALMACENA LIKES DE UN USUARIO A UNA RECETA
         return auth()->user()->meGusta()->toggle($receta);
    }   
}
