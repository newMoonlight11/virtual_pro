@extends('layouts.user_type.auth')

@section('content')
    <div class="container py-4">
        <h3>Simulacros Disponibles</h3>

        @if ($simulacros->isEmpty())
            <p>No hay simulacros disponibles en este momento.</p>
        @else
            <div class="list-group">
                @foreach ($simulacros as $simulacro)
                    @if ($simulacro->presentado)
                        <div class="list-group-item bg-light text-muted">
                            <h5>{{ $simulacro->titulo }}</h5>
                            <p>{{ $simulacro->descripcion }}</p>
                            <small><strong>Fecha:</strong> {{ $simulacro->fecha }}</small>
                            <span class="badge bg-secondary">Ya presentado</span>
                        </div>
                    @elseif (!$simulacro->disponible)
                        <div class="list-group-item bg-warning text-dark">
                            <h5>{{ $simulacro->titulo }}</h5>
                            <p>{{ $simulacro->descripcion }}</p>
                            <small><strong>Fecha:</strong> {{ $simulacro->fecha }}</small>
                            <span class="badge bg-danger">No disponible aún</span>
                        </div>
                    @else
                        <a href="{{ route('estudiante.realizar_simulacro', $simulacro->id) }}"
                            class="list-group-item list-group-item-action">
                            <h5>{{ $simulacro->titulo }}</h5>
                            <p>{{ $simulacro->descripcion }}</p>
                            <small><strong>Fecha:</strong> {{ $simulacro->fecha }}</small>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection
