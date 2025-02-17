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
                            <td colspan="5">
                                <form action="{{ route('profesor.cronograma.actualizar', $evento->id) }}" method="POST"
                                    style="display:flex; gap: 10px;">
                                    @csrf
                                    @method('PUT')

                                    <input type="date" name="fecha"
                                        value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d') }}"
                                        class="form-control">

                                    <input type="text" name="evento" value="{{ $evento->evento }}" class="form-control">

                                    <input type="time" name="hora"
                                        value="{{ \Carbon\Carbon::parse($evento->fecha)->format('H:i') }}"
                                        class="form-control">

                                    <button type="submit" class="btn btn-warning btn-sm">Actualizar</button>
                                </form>

                                <form action="{{ route('profesor.cronograma.eliminar', $evento->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este evento?');">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay eventos programados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
