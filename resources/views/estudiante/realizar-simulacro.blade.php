@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>{{ $simulacro->titulo }}</h3>
        <p>{{ $simulacro->descripcion }}</p>
        <form action="{{ route('estudiante.guardar_respuestas', $simulacro->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Finalizar Simulacro</button>
        </form>
    </div>
@endsection
