@extends('layouts.app')


@section('content')
{{-- {{$perfil->usuario->recetas}} --}}

<div class="container">
    <div class="row">
        <div class="col-md-5">

        </div>
        <div class="col-md-7">
            <h2 class="text-center mb-2text-primary">{{$perfil->usuario->name}}</h2>
            <a href="{{$perfil->usuario->url}}">Visitar Sitio Web</a>

            <div class="biografia">
                {!! $perfil->biografia !!}
            </div>
            
        </div>
    </div>
</div>

@endsection