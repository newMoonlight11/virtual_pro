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
                    <th class="text-center"><strong>Título</strong></th>
                    <th class="text-center"><strong>Subtítulo</strong></th>
                    <th class="text-center"><strong>Contenido</strong></th>
                    <th class="text-center"><strong>Acciones</strong></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anuncios as $anuncio)
                    <tr>
                        <form action="{{ route('profesor.actualizar_anuncio', $anuncio->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <td>
                                <input type="text" name="titulo" value="{{ $anuncio->titulo }}" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="subtitulo" value="{{ $anuncio->subtitulo ?? 'Sin subtítulo' }}"
                                    class="form-control">
                            </td>
                            <td>
                                <input type="text" name="contenido" value="{{ $anuncio->contenido }}"
                                    class="form-control">
                            </td>
                            {{-- <td class="text-center">{{ $anuncio->titulo }}</td>
                        <td class="text-center">{{ $anuncio->subtitulo ?? 'Sin subtítulo' }}</td>
                        <td class="text-center">{{ Str::limit($anuncio->contenido, 20) }}</td> --}}
                            <td class="text-center">
                                {{-- <div style="display: flex; gap: 5px; align-items: center; justify-content: center;"> --}}
                                    <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Actualizar anuncio">
                                        <i class="bi bi-arrow-repeat fs-6 text-success"></i>
                                    </button>
                        </form>
                       
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
