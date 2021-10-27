<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
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
        // auth()->user()->recetas->dd(); 1° FORMA
        // Auth::user()->recetas->dd(); 2° FORMA
       
        $recetas = auth()->user()->recetas;

       return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();
        //EN PLUCK COLOCAMOS LOS ELEMENTOS QUE QUEREMOS

        //OBTENER CATEGORIAS SIN MODELO
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
       
        //OBTENER CATEGORIAS CON MODELO
        $categorias = CategoriaReceta::all(['id', 'nombre']);



        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd( $request['imagen']->store('upload-recetas', 'public'));

        //VALIDACION
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required'
        ]);

        //OBTENER LA RUTA DE LA IMAGEN
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //RESIZE DE LA IMAGEN
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        //ALMACENAR EN BD SIN MODELO
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,  
        //     'user_id' => Auth::user()->id, //DEVUELVE QUE USUARIO ESTA AUTENTICADO
        //     'categoria_id' => $data['categoria']   
        // ]);

        //ALMACENAR EN BD CON MODELO
        auth()->user()->recetas()->create([
             'titulo' => $data['titulo'],
             'preparacion' => $data['preparacion'],
             'ingredientes' => $data['ingredientes'],
             'imagen' => $ruta_imagen,  
             'categoria_id' => $data['categoria']   
        ]);

        //REDIRECCIONAR
        return redirect()->action('RecetaController@index');

        //dd( $request->all() );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //OBTENER CATEGORIAS CON MODELO
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
       return "editando";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
