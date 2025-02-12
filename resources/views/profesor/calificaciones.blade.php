@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Gestión de Calificaciones</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Simulacro</th>
                    <th>Puntaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($calificaciones as $calificacion)
                    <tr>
                        <td>{{ $calificacion->estudiante->name }}</td>
                        <td>{{ $calificacion->simulacro->titulo }}</td>
                        <td>{{ $calificacion->puntaje }}</td>
                        <td>
                            <a href="{{ route('profesor.editar_calificacion', $calificacion->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('profesor.eliminar_calificacion', $calificacion->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar esta calificación?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
