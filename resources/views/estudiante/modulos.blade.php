@extends('layouts.user_type.auth')

@section('content')
    <style>
        /* Opcional: estilo para que las tarjetas tengan bordes redondeados y sombra */
        .modulo-card {
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }

        .modulo-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Centrado vertical y horizontal del contenido */
        .modulo-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Ícono dentro de la tarjeta */
        .modulo-icon {
            width: 80px;
            /* Ajusta según tu preferencia */
            height: 80px;
            object-fit: contain;
            /* Ajusta si usas imágenes con fondo */
        }
    </style>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card p-4">
                    <h3 class="mb-3">Módulos de Aprendizaje</h3>

                    <!-- Formulario de búsqueda -->
                    <form action="{{ route('estudiante.modulos') }}" method="GET" class="mb-4">
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
                                <a href="{{ route('estudiante.modulos') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync"></i> Restablecer
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Contenedor de módulos en formato "cards" -->
                    <!-- row-cols: en pantallas pequeñas 1 columna, medianas 2, grandes 4, etc. -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        @foreach ($modulos as $modulo)
                            <div class="col">
                                <div class="card text-center shadow-sm modulo-card">
                                    <div class="card-body">
                                        <!-- Ícono (puedes usar una imagen distinta para cada módulo
                                             o un ícono genérico) -->
                                        <img src="{{ asset('assets/img/icons/materia.png') }}" alt="Icono Módulo"
                                            class="modulo-icon">

                                        <!-- Nombre del Módulo -->
                                        <h5 class="mt-3">{{ $modulo->nombre }}</h5>

                                        <!-- Botón para abrir modal -->
                                        <button class="btn btn-primary mt-2" data-bs-toggle="modal"
                                            data-bs-target="#moduloModal-{{ $modulo->id }}">
                                            Ver más
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal con la información del módulo -->
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

                                            <!-- Lista de archivos -->
                                            @if ($modulo->archivos->count())
                                                <div class="mt-3">
                                                    <h6>Archivos disponibles:</h6>
                                                    <ul class="list-group">
                                                        @foreach ($modulo->archivos as $archivo)
                                                            <li class="list-group-item">
                                                                <a href="#"
                                                                    onclick="mostrarPDF('{{ asset('storage/' . $archivo->ruta) }}', {{ $modulo->id }}); return false;">
                                                                    <i class="fas fa-file-pdf text-danger"></i>
                                                                    {{ $archivo->nombre }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <!-- Visor de PDF -->
                                                <div id="contenedorVisor-{{ $modulo->id }}" class="mt-3"
                                                    style="display: none;">
                                                    <iframe id="visorPDF-{{ $modulo->id }}" src="" width="100%"
                                                        height="500px">
                                                    </iframe>
                                                    <button class="btn btn-danger mt-2"
                                                        onclick="cerrarPDF({{ $modulo->id }})">
                                                        Cerrar Visor
                                                    </button>
                                                </div>
                                            @else
                                                <p class="text-muted">
                                                    No hay archivos disponibles en este módulo.
                                                </p>
                                            @endif

                                            <script>
                                                function mostrarPDF(url, moduloId) {
                                                    var visor = document.getElementById('visorPDF-' + moduloId);
                                                    var contenedorVisor = document.getElementById('contenedorVisor-' + moduloId);

                                                    visor.src = url;
                                                    contenedorVisor.style.display = 'block';
                                                }

                                                function cerrarPDF(moduloId) {
                                                    var visor = document.getElementById('visorPDF-' + moduloId);
                                                    var contenedorVisor = document.getElementById('contenedorVisor-' + moduloId);

                                                    visor.src = "";
                                                    contenedorVisor.style.display = 'none';
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del modal -->
                        @endforeach
                    </div> <!-- Fin row cols -->
                </div>
            </div>
        </div>
    </div>
@endsection
