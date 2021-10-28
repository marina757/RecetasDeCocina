<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
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
        //
        return view('perfiles.show', compact('perfil') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
