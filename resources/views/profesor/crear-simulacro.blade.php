@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Crear Nuevo Simulacro</h3>
        <form action="{{ route('profesor.simulacros.store') }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('profesor.simulacros.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
