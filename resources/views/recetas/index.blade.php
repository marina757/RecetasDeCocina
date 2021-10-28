@extends('layouts.app')

@section('botones')
{{-- {{ Auth::user()}} --}}
<a href="{{ route('recetas.create')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">Crear Receta</a>
<a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ])}}" class="btn btn-outline-success mr-2 text-uppercase font-weight-bold">Editar Perfil</a> 
<a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id ])}}" class="btn btn-outline-info mr-2 text-uppercase font-weight-bold">Ver Perfil</a> 
@endsection


@section( 'content')

<h2 class="text-center mb-5">Administra tus recetas</h2>

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($recetas as $receta)
                    
              
                <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>
                        {{-- <form action="{{ route('recetas.destroy', ['receta' => $receta->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar &times;">
                        </form> --}}

                            <eliminar-receta 
                            receta-id={{$receta->id}}>
                                    
                            </eliminar-receta>
                       
                        
                        <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}"  class="btn btn-dark d-block mb-2">Editar</a>
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success d-block mb-2">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>

@endsection