@extends('layouts.user_type.auth')

@section('content')
    <style>
        /* Contenedor principal más ancho en pantallas grandes */
        .card.p-4 {
            width: 100%;
            max-width: none;
            margin: auto;
        }

        /* Contenedor de módulos: se adapta dinámicamente */
        .row.modulos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        /* Estilo para las tarjetas */
        .modulo-card {
            width: 100%;
            max-width: 350px;
            /* Un poco más grande */
            height: auto;
            /* Se ajusta al contenido */
            color: white !important;
            font-weight: bold;
            padding: 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-align: center;
        }

        /* Efecto hover para que el módulo sobresalga */
        .modulo-card:hover {
            transform: scale(1.05);
            /* Aumenta ligeramente el tamaño */
            transition: transform 0.2s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            /* Agrega sombra */
        }

        .card-header {
            width: 100%;
            height: 50px;
            /* Altura fija para evitar que crezca */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-title {
            max-width: 90%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        /* Contenedor de botones con flex para alinearlos correctamente */
        .card-footer {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            /* Espaciado uniforme */
            padding: 10px;
        }

        /* Tamaño fijo para los botones */
        .card-footer .btn {
            flex: 1;
            /* Que ambos botones ocupen el mismo espacio */
            text-align: center;
            padding: 8px 0;
            font-size: 14px;
            font-weight: bold;
        }

        /* Distribuir mejor las tarjetas en pantallas grandes */
        @media (min-width: 768px) {
            .modulo-card {
                max-width: 250px;
                /* Más ajustado en pantallas medianas */
            }
        }

        @media (min-width: 1024px) {
            .row.modulos-container {
                justify-content: flex-start;
                /* Más alineado en pantallas grandes */
            }

            .modulo-card {
                max-width: 280px;
                /* Más espacio para los módulos */
            }
        }
    </style>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- CONTENEDOR BLANCO MÁS ANCHO -->
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
                                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>
                                    Buscar</button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary"><i
                                        class="fas fa-sync"></i>
                                    Restablecer</a>
                            </div>
                        </div>
                    </form>

                    <!-- Contenedor de módulos en tarjetas -->
                    <div class="row modulos-container">
                        @foreach ($modulos as $modulo)
                            <div class="col-md-4 col-lg-3"> <!-- Se ajusta mejor en pantallas grandes -->
                                <div class="card">
                                    <div class="card-header bg-primary text-white modulo-card" data-bs-toggle="modal"
                                        data-bs-target="#moduloModal-{{ $modulo->id }}">
                                        {{ $modulo->nombre }}
                                    </div>
                                    <div class="card-footer d-flex justify-content-between p-2">
                                        <a href="{{ route('profesor.editar_modulo', $modulo->id) }}"
                                            class="btn btn-sm w-50 me-1" data-bs-toggle="tooltip"
                                            data-bs-original-title="Editar módulo">
                                            <i class="fas fa-edit fs-6 text-success"></i>
                                        </a>
                                        <form action="{{ route('profesor.eliminar_modulo', $modulo->id) }}" method="POST"
                                            class="w-50" data-bs-toggle="tooltip"
                                            data-bs-original-title="Eliminar módulo">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm w-100"
                                                onclick="return confirm('¿Eliminar este módulo?');">
                                                <i class="fas fa-trash fs-6 text-danger"></i>
                                            </button>
                                        </form>
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
                                                                    target="_blank">{{ $archivo->nombre }}</a>
                                                                <form
                                                                    action="{{ route('profesor.eliminar_archivo', $archivo->id) }}"
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
                    </div> <!-- CIERRE DEL ROW -->

                </div> <!-- CIERRE DEL CONTENEDOR CARD -->

            </div> <!-- CIERRE DE COL-12 -->
        </div> <!-- CIERRE DEL ROW -->
    </div> <!-- CIERRE DEL CONTAINER -->
@endsection
