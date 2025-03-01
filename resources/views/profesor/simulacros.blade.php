@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 bg-white border-radius-lg">
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
                        Reiniciar</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('profesor.simulacros.create') }}" class="btn btn-secondary"><i
                            class="fas fa-plus"></i>
                        Nuevo</a>
                </div>
            </div>
        </form>

        <!-- Tabla de simulacros -->
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center"><strong>Título</strong></th>
                    <th class="text-center"><strong>Fecha</strong></th>
                    <th class="text-center"><strong>Hora</strong></th>
                    <th class="text-center"><strong>Acciones</strong></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($simulacros as $simulacro)
                    <tr>
                        <form action="{{ route('profesor.simulacros.update', $simulacro->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="text" name="titulo" value="{{ $simulacro->titulo }}" class="form-control">
                            </td>

                            <td>
                                <input type="date" name="fecha"
                                    value="{{ \Carbon\Carbon::parse($simulacro->fecha)->format('Y-m-d') }}"
                                    class="form-control">
                            </td>

                            <!-- Hora -->
                            <td>
                                <input type="time" name="hora"
                                    value="{{ \Carbon\Carbon::parse($simulacro->fecha)->format('H:i') }}"
                                    class="form-control">
                            </td>

                            <!-- Acciones -->
                            <td class="text-center">
                                {{-- <div style="display: flex; gap: 1px; align-items: center; justify-content: center;"> --}}
                                    <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip"
                                        data-bs-original-title="Actualizar simulacro">
                                        <i class="bi bi-arrow-repeat fs-6 text-success"></i>
                                    </button>
                        </form>
                        {{-- <td class="text-center">{{ $simulacro->titulo }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($simulacro->fecha)->format('d/m/Y') }}</td> --}}
                       
                            <form action="{{ route('profesor.simulacros.destroy', $simulacro->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm"
                                    onclick="return confirm('¿Eliminar este simulacro?');" data-bs-toggle="tooltip"
                                    data-bs-original-title="Eliminar simulacro">
                                    <i class="fas fa-trash fs-6 text-danger"></i>
                                </button>
                                <a href="{{ route('profesor.simulacros.test', $simulacro->id) }}" class="btn btn-sm"
                                    data-bs-toggle="tooltip" data-bs-original-title="Probar simulacro">
                                    <i class="fas fa-play text-primary fs-6"></i>
                                </a>
                                {{-- <button type="submit" class="btn btn-sm"
                                    onclick="{{ route('profesor.simulacros.preview') }}">
                                    <i class="fas fa-eye fs-6 text-secondary"></i> 
                                </button> --}}
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

<style>
    .box_shadow:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.074);
        */
    }
</style>
