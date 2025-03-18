@extends('layouts.user_type.auth')

@section('content')
    <style>
        /* Efecto hover para que el módulo sobresalga */
        .modulo-card:hover {
            transform: scale(1.05);
            /* Aumenta ligeramente el tamaño */
            transition: transform 0.2s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            /* Agrega sombra */
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
                                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>
                                    Buscar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('estudiante.modulos') }}" class="btn btn-secondary"><i
                                        class="fas fa-sync"></i>
                                    Restablecer</a>
                            </div>
                        </div>
                    </form>

                    <!-- Contenedor de módulos en tarjetas -->
                    <div class="row modulos-container">
                        @foreach ($modulos as $modulo)
                            <div class="col-md-4 col-lg-3">
                                <div class="card">
                                    <div class="card-header bg-primary text-white modulo-card" data-bs-toggle="modal"
                                        data-bs-target="#moduloModal-{{ $modulo->id }}">
                                        {{ $modulo->nombre }}
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
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
                                                    <a href="{{ $modulo->link_reunion }}"
                                                        target="_blank">{{ $modulo->link_reunion }}</a>
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

                                                <!-- Espacio para mostrar el visor de PDF de este módulo -->
                                                <div id="contenedorVisor-{{ $modulo->id }}" class="mt-3"
                                                    style="display: none;">
                                                    <iframe id="visorPDF-{{ $modulo->id }}" src="" width="100%"
                                                        height="500px"></iframe>
                                                    <button class="btn btn-danger mt-2"
                                                        onclick="cerrarPDF({{ $modulo->id }})">Cerrar Visor</button>
                                                </div>
                                            @else
                                                <p class="text-muted">No hay archivos disponibles en este módulo.</p>
                                            @endif

                                            <script>
                                                function mostrarPDF(url, moduloId) {
                                                    var visor = document.getElementById('visorPDF-' + moduloId);
                                                    var contenedorVisor = document.getElementById('contenedorVisor-' + moduloId);

                                                    visor.src = url;
                                                    contenedorVisor.style.display = 'block'; // Hace visible el visor
                                                }

                                                function cerrarPDF(moduloId) {
                                                    var visor = document.getElementById('visorPDF-' + moduloId);
                                                    var contenedorVisor = document.getElementById('contenedorVisor-' + moduloId);

                                                    visor.src = ""; // Vacía la fuente del PDF
                                                    contenedorVisor.style.display = 'none'; // Oculta el visor
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- CIERRE DEL ROW -->
                </div> <!-- CIERRE DEL CONTENEDOR CARD -->
            </div> <!-- CIERRE DE COL-12 -->
        </div> <!-- CIERRE DEL ROW -->
    </div> <!-- CIERRE DEL CONTAINER -->
@endsection
