@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Gestión de Simulacros</h3>
        <a href="{{ route('profesor.simulacros.create') }}" class="btn btn-primary">+ Nuevo Simulacro</a>
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
                            <form action="{{ route('profesor.simulacros.destroy', $simulacro->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este simulacro?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
