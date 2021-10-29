<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //OBTENER LAS RECETAS CON PAGINACION
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(10);
        return view('perfiles.show', compact('perfil', 'recetas') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //EJECUTAR EL POLICY
        $this->authorize('view', $perfil);
        //
        return view('perfiles.edit', compact('perfil') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //EJECUTAR EL POLICY
        $this->authorize('update', $perfil);

        // dd( $request['imagen'] );
        //VALIDAR
        $data = request()->validate( [
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        //SI USUARIO SUBE IMAGEN
    //    if ( $request['imagen']) {
    //        return "Si se subio una imagen";
    //    } else {
    //        return "no se subio";
    //    }

        if ( $request['imagen']) {
            //OBTENER LA RUTA DE LA IMAGEN
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //RESIZE DE LA IMAGEN
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //CREAR UN ARREGLO DE IMAGEN
            $array_imagen = ['imagen' => $ruta_imagen];
         }



        //ASIGNAR NOMBRE Y URL
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //ELIMINAR URL Y NAME DE $DATA
        unset($data['url']);
        unset($data['nombre']);
         //GUARDAR INFO

        //ASIGNAR BIOGRAFIA E IMAGEN
        auth()->user()->perfil()->update( array_merge(

            $data,
            $array_imagen ?? []
        ) );
       
        //REDIRECCIONAR
        return redirect()->action('RecetaController@index');
    }

}
