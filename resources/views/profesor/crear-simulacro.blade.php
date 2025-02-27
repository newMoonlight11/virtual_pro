@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 card">
        <div class="card-header text-white bg-secondary">
            <h5 class="m-0 text-white">Crear Nuevo Simulacro</h5>
        </div>
        <form action="{{ route('profesor.simulacros.preview') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="datetime-local" name="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Subir Preguntas (Archivo Excel)</label>
                <input type="file" name="archivo_preguntas" class="form-control" accept=".xlsx, .xls, .csv" required>
            </div>
            <button type="submit" class="btn btn-success">Previsualizar Preguntas</button>
            <a href="{{ route('profesor.simulacros.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
