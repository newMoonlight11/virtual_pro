@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="m-0 text-white">Crear Nuevo Anuncio</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profesor.guardar_anuncio') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subtítulo</label>
                        <input type="text" name="subtitulo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contenido</label>
                        <textarea name="contenido" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('profesor.anuncios') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
