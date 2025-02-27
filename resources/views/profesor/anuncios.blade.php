@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 card">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Gestión de Anuncios</h3>
            <a href="{{ route('profesor.crear_anuncio') }}" class="btn btn-primary">+ Nuevo Anuncio</a>
        </div>
        <table class="table mt-3 card-body">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Subtítulo</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anuncios as $anuncio)
                    <tr>
                        <td>{{ $anuncio->titulo }}</td>
                        <td>{{ $anuncio->subtitulo ?? 'Sin subtítulo' }}</td>
                        <td>{{ $anuncio->contenido }}</td>
                        <td>
                            <form action="{{ route('profesor.eliminar_anuncio', $anuncio->id) }}" method="POST"
                                style="display:inline;" data-bs-toggle="tooltip" data-bs-original-title="Eliminar anuncio">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm"
                                    onclick="return confirm('¿Eliminar este anuncio?');">
                                    <i class="fas fa-trash fs-6 text-danger"></i> 
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
