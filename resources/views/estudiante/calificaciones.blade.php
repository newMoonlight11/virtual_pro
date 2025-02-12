@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Mis Calificaciones</h3>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Simulacro</th>
                    <th>Puntaje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calificaciones as $calificacion)
                    <tr>
                        <td>{{ $calificacion->simulacro->titulo }}</td>
                        <td>{{ $calificacion->puntaje }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
