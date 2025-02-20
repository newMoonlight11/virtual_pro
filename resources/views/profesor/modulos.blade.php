@extends('layouts.user_type.auth')

@section('content')
    <style>
        .modulo-card {
            width: 300px;
            /* Fija el ancho para que todos los módulos sean iguales */
            height: 50px;
            /* Fija la altura para evitar cambios de tamaño */
            color: white !important;
            font-weight: bold;
            padding: 10px 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
            /* Evita que el texto se divida en varias líneas */
            text-overflow: ellipsis;
            /* Muestra "..." si el texto es demasiado largo */
        }

        .card {
            display: inline-block;
            margin-bottom: 10px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .modulo-card:hover {
            transform: scale(1.05);
        }

        .modulo-card .card-header {
            cursor: pointer;
            font-weight: bold;
        }

        .modulo-card .card-body {
            background-color: #f8f9fa;
            padding: 15px;
        }
    </style>
    <div class="container py-4">
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

        <!-- Contenedor de módulos en tarjetas -->
        <div class="row">
            @foreach ($modulos as $modulo)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white modulo-card" data-bs-toggle="modal"
                            data-bs-target="#moduloModal-{{ $modulo->id }}">
                            {{ $modulo->nombre }}
                        </div>
                        <div class="card-footer d-flex justify-content-between p-2">
                            <a href="{{ route('profesor.editar_modulo', $modulo->id) }}"
                                class="btn btn-warning btn-sm w-50 me-1">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('profesor.eliminar_modulo', $modulo->id) }}" method="POST"
                                class="w-50">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('¿Eliminar este módulo?');">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para mostrar el módulo en pantalla completa -->
                <div class="modal fade" id="moduloModal-{{ $modulo->id }}" tabindex="-1"
                    aria-labelledby="moduloModalLabel-{{ $modulo->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-width: 70%;">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="moduloModalLabel-{{ $modulo->id }}">
                                    {{ $modulo->nombre }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $modulo->descripcion }}</p>

                                <!-- Formulario de carga de archivos -->
                                <form action="{{ route('profesor.subir_archivo', $modulo->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <input type="file" name="archivo" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" name="nombre_personalizado" class="form-control"
                                            placeholder="Nombre del archivo (opcional)">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-upload"></i> Subir Archivo
                                    </button>
                                </form>

                                <!-- Lista de archivos -->
                                @if ($modulo->archivos->count())
                                    <div class="mt-3">
                                        <h6>Archivos subidos:</h6>
                                        <ul class="list-group">
                                            @foreach ($modulo->archivos as $archivo)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <a href="{{ asset('storage/' . $archivo->ruta) }}"
                                                        target="_blank">{{ $archivo->nombre }}</a>
                                                    <form action="{{ route('profesor.eliminar_archivo', $archivo->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('¿Eliminar este archivo?');">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
