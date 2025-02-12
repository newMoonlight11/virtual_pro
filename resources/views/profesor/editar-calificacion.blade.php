@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Editar Calificación</h3>
        <form action="{{ route('profesor.actualizar_calificacion', $calificacion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Puntaje</label>
                <input type="number" name="puntaje" value="{{ $calificacion->puntaje }}" class="form-control" min="0"
                    max="100" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('profesor.calificaciones') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
