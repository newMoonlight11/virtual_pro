@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Gestión de Simulacros</h3>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('profesor.simulacros.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="titulo" class="form-control" placeholder="Buscar por título..."
                        value="{{ request('titulo') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('profesor.simulacros.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i>
                        Restablecer</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('profesor.simulacros.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i>
                        Nuevo</a>
                </div>
            </div>
        </form>

        <!-- Tabla de simulacros -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($simulacros as $simulacro)
                    <tr>
                        <td>{{ $simulacro->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($simulacro->fecha)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <form action="{{ route('profesor.simulacros.destroy', $simulacro->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este simulacro?');">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No se encontraron simulacros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
