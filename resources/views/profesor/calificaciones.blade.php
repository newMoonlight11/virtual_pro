@extends('layouts.user_type.auth')

@section('content')
    <div class="container py-4">
        <h3>Calificaciones de Simulacros</h3>

        @if ($calificaciones->isEmpty())
            <p>No hay calificaciones registradas.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Simulacro</th>
                        <th>Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificaciones as $calificacion)
                        <tr>
                            <td>{{ $calificacion->estudiante->name }}</td>
                            <td>{{ $calificacion->simulacro->titulo }}</td>
                            <td>{{ $calificacion->puntaje }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
