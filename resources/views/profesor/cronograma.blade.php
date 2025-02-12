@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Cronograma</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->evento }}</td>
                        <td>{{ $evento->fecha }}</td>
                        <td>
                            <a href="{{ route('profesor.editar_cronograma', $evento->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('profesor.eliminar_cronograma', $evento->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este evento?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
