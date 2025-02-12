@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Gestión de Anuncios</h3>
        <a href="{{ route('profesor.crear_anuncio') }}" class="btn btn-primary">+ Nuevo Anuncio</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anuncios as $anuncio)
                    <tr>
                        <td>{{ $anuncio->titulo }}</td>
                        <td>{{ $anuncio->contenido }}</td>
                        <td>
                            <form action="{{ route('profesor.eliminar_anuncio', $anuncio->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este anuncio?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
