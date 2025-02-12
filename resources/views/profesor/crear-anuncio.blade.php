@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Crear Nuevo Anuncio</h3>
        <form action="{{ route('profesor.guardar_anuncio') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contenido</label>
                <textarea name="contenido" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
            <a href="{{ route('profesor.anuncios') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
