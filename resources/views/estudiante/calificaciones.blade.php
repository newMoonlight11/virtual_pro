@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Mis Calificaciones</h3>

        @if ($calificaciones->isEmpty())
            <p>No tienes calificaciones registradas.</p>
        @else
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Simulacro</th>
                        <th>Fecha</th>
                        <th>Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificaciones as $calificacion)
                        <tr>
                            <td>{{ $calificacion->titulo_simulacro }}</td>
                            <td>{{ $calificacion->created_at->format('d/m/Y') }}</td>
                            <td>{{ $calificacion->puntaje }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
