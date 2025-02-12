@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Simulacros Disponibles</h3>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($simulacros as $simulacro)
                    <tr>
                        <td>{{ $simulacro->titulo }}</td>
                        <td>{{ $simulacro->fecha }}</td>
                        <td>
                            <a href="{{ route('estudiante.realizar_simulacro', $simulacro->id) }}"
                                class="btn btn-success btn-sm">Realizar Simulacro</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
