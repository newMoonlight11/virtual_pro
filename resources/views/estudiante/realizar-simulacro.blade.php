@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>{{ $simulacro->titulo }}</h3>
        <p>{{ $simulacro->descripcion }}</p>
        <form action="{{ route('estudiante.guardar_respuestas', $simulacro->id) }}" method="POST">
            @csrf
            @foreach ($simulacro->preguntas as $pregunta)
                <div class="mb-3">
                    <p><strong>{{ $pregunta->enunciado }}</strong></p>
                    @foreach ($pregunta->respuestas as $respuesta)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pregunta_{{ $pregunta->id }}"
                                value="{{ $respuesta->id }}">
                            <label class="form-check-label">{{ $respuesta->opcion }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Finalizar Simulacro</button>
        </form>
    </div>
@endsection
