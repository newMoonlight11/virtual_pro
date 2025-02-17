@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Gestión de Módulos</h3>
            <a href="{{ route('profesor.crear_modulo') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo Módulo
            </a>
        </div>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('profesor.modulos') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..."
                        value="{{ request('nombre') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary"><i class="fas fa-sync"></i>
                        Restablecer</a>
                </div>
            </div>
        </form>

        <!-- Tabla de módulos -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nombre }}</td>
                        <td>{{ $modulo->descripcion }}</td>
                        <td class="text-center">
                            <a href="{{ route('profesor.editar_modulo', $modulo->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('profesor.eliminar_modulo', $modulo->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este módulo?');">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No se encontraron módulos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
