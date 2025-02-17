@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Agregar Pregunta</h3>
        <form action="{{ route('profesor.guardar_pregunta', $simulacro_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Enunciado</label>
                <textarea name="enunciado" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Opciones</label>
                @for ($i = 0; $i < 4; $i++)
                    <div class="form-check">
                        <input type="radio" name="correcta" value="{{ $i }}" required>
                        <input type="text" name="opciones[]" class="form-control" required>
                    </div>
                @endfor
            </div>

            <button type="submit" class="btn btn-primary">Guardar Pregunta</button>
            <a href="{{ route('profesor.simulacros') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
