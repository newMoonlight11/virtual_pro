@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 card">
        <h3 class="mb-4">Mi Cronograma</h3>
        <p>Aquí puedes ver tu calendario de clases y simulacros.</p>

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

            .table tbody tr td {
                height: 60px;
                text-align: center;
            }

            .empty-table td {
                height: 150px;
                font-size: 18px;
                color: #888;
                text-align: center;
                vertical-align: middle;
            }
        </style>

        <!-- Tabla de eventos -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Fecha</th>
                        <th>Actividad</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($eventos as $evento)
                        <tr>
                            <!-- Día -->
                            <td>
                                {{ \Carbon\Carbon::parse($evento->fecha)->locale('es')->isoFormat('dddd') }}
                            </td>

                            <!-- Fecha -->
                            <td>
                                {{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d') }}
                            </td>

                            <!-- Actividad -->
                            <td>
                                {{ $evento->evento }}
                            </td>

                            <!-- Hora -->
                            <td>
                                {{ \Carbon\Carbon::parse($evento->fecha)->format('H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-table">
                            <td colspan="4">No hay eventos programados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
