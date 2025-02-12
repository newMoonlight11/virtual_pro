@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Anuncios</h3>
        @foreach ($anuncios as $anuncio)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $anuncio->titulo }}</h5>
                    <p class="card-text">{{ $anuncio->contenido }}</p>
                    <p class="text-muted">Publicado por: {{ $anuncio->autor->name }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
