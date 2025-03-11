@extends('layouts.user_type.auth')
@section('content')
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="m-0 text-white">Crear nuevo video</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profesor.guardar_video') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Título del Video</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Enlace de YouTube</label>
                    <input type="url" name="youtube_url" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('profesor.video') }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
