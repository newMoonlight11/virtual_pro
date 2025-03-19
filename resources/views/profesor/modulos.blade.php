@extends('layouts.user_type.auth')

@section('content')
    <style>
        /* Tarjetas con estilo similar a la vista de estudiante */
        .modulo-card {
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }

        .modulo-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Centrar contenido dentro de la tarjeta */
        .modulo-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Ícono del módulo */
        .modulo-icon {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Gestión de Módulos</h3>
                        <a href="{{ route('profesor.crear_modulo') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Módulo
                        </a>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <form action="{{ route('profesor.modulos') }}" method="GET" class="mb-4">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre..."
                                    value="{{ request('nombre') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync"></i> Restablecer
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Grid de tarjetas -->
                    <!-- row-cols: en pantallas pequeñas 1 col, medianas 2, grandes 4, etc. -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        @foreach ($modulos as $modulo)
                            <div class="col">
                                <div class="card text-center shadow-sm modulo-card">
                                    <div class="card-body">
                                        <!-- Ícono del módulo -->
                                        <img src="{{ asset('assets/img/icons/materia.png') }}" alt="Icono Módulo"
                                            class="modulo-icon">

                                        <!-- Nombre del módulo -->
                                        <h5 class="mt-3">{{ $modulo->nombre }}</h5>

                                        <!-- Botones Editar / Eliminar -->
                                        <div class="d-flex justify-content-center mt-2">
                                            <!-- Editar -->
                                            <a href="{{ route('profesor.editar_modulo', $modulo->id) }}"
                                                class="btn btn-sm btn-outline-success me-2" data-bs-toggle="tooltip"
                                                data-bs-original-title="Editar módulo">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Eliminar -->
                                            <form action="{{ route('profesor.eliminar_modulo', $modulo->id) }}"
                                                method="POST" onsubmit="return confirm('¿Eliminar este módulo?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Botón para abrir el modal -->
                                        <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                            data-bs-target="#moduloModal-{{ $modulo->id }}">
                                            Ver más
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal con información del módulo -->
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

                                            @if ($modulo->link_reunion)
                                                <p>
                                                    <strong>Reunión Virtual:</strong>
                                                    <a href="{{ $modulo->link_reunion }}" target="_blank">
                                                        {{ $modulo->link_reunion }}
                                                    </a>
                                                </p>
                                            @endif

                                            <!-- Subir archivos -->
                                            <form action="{{ route('profesor.subir_archivo', $modulo->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-2">
                                                    <input type="file" name="archivo" class="form-control" accept=".pdf"
                                                        required>
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
                                                                    target="_blank">
                                                                    {{ $archivo->nombre }}
                                                                </a>
                                                                <form
                                                                    action="{{ route('profesor.eliminar_archivo', $archivo->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('¿Eliminar este archivo?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div> <!-- modal-body -->
                                    </div>
                                </div>
                            </div> <!-- Fin modal -->
                        @endforeach
                    </div> <!-- Fin row cols -->
                </div>
            </div>
        </div>
    </div>
@endsection
