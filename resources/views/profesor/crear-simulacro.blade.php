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

            <!-- Fecha/hora de inicio -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha y Hora de Inicio</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
            </div>

            <!-- Fecha/hora de fin -->
            <div class="mb-3">
                <label for="hora_fin" class="form-label">Fecha y Hora de Fin</label>
                <input type="datetime-local" class="form-control" id="hora_fin" name="hora_fin" required>
            </div>

            <!-- Subir Preguntas -->
            <div class="mb-3">
                <label class="form-label">Subir Preguntas (Archivo Excel)</label>
                <input type="file" name="archivo_preguntas" class="form-control" accept=".xlsx, .xls, .csv" required>
            </div>

            <button type="submit" class="btn btn-success">Previsualizar Preguntas</button>
            <a href="{{ route('profesor.simulacros.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
