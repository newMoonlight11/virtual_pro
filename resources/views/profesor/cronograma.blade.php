@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3 class="mb-4">Cronograma de Actividades</h3>

        <!-- Formulario para agregar un nuevo evento -->
        <form action="{{ route('profesor.cronograma.guardar') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="evento" class="form-control" placeholder="Nombre del evento" required>
                </div>
                <div class="col-md-3">
                    <input type="datetime-local" name="fecha" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Agregar Evento</button>
                </div>
            </div>
        </form>

        <!-- Estilos -->
        <style>
            .table-responsive {
                display: flex;
                justify-content: center;
                width: 100%;
            }

            .table {
                width: 80%;
                max-width: 100%;
                min-width: 600px;
            }

            /* Evita que la tabla colapse cuando no hay registros */
            .table tbody tr td {
                height: 60px;
                /* Altura mínima de las filas */
                text-align: center;
            }

            /* Si no hay eventos, asegurar que la tabla mantenga su tamaño */
            .empty-table td {
                height: 150px;
                font-size: 18px;
                color: #888;
                text-align: center;
                vertical-align: middle;
            }

            /* Estilos adicionales para hacer que los botones se vean bien */
            .btn-sm {
                font-size: 14px;
                padding: 5px 10px;
            }
        </style>

        <!-- Tabla de eventos -->
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Día</th>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($eventos as $evento)
                        <tr>
                            <form action="{{ route('profesor.cronograma.actualizar', $evento->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Día -->
                                <td>
                                    <input type="text"
                                        value="{{ \Carbon\Carbon::parse($evento->fecha)->locale('es')->isoFormat('dddd') }}"
                                        class="form-control" disabled style="text-align: center;">
                                </td>

                                <!-- Fecha -->
                                <td>
                                    <input type="date" name="fecha"
                                        value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d') }}"
                                        class="form-control">
                                </td>

                                <!-- Actividad -->
                                <td>
                                    <input type="text" name="evento" value="{{ $evento->evento }}" class="form-control">
                                </td>

                                <!-- Hora -->
                                <td>
                                    <input type="time" name="hora"
                                        value="{{ \Carbon\Carbon::parse($evento->fecha)->format('H:i') }}"
                                        class="form-control">
                                </td>

                                <!-- Acciones -->
                                <td>
                                    <div style="display: flex; gap: 5px; align-items: center; justify-content: center;">
                                        <button type="submit" class="btn btn-warning btn-sm">Actualizar</button>
                            </form> <!-- Cierre del formulario de actualizar -->

                            <form action="{{ route('profesor.cronograma.eliminar', $evento->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este evento?');">
                                    Eliminar
                                </button>
                            </form>
        </div>
        </td>
        </tr>
    @empty
        <tr class="empty-table">
            <td colspan="5">No hay eventos programados.</td>
        </tr>
        @endforelse
        </tbody>
        </table>
    </div>
    </div>
@endsection
