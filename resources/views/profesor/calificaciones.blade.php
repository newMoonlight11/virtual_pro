@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 card">
        <h3 class="mb-4">Calificaciones de Simulacros</h3>

        <!-- Estilos mejorados -->
        <style>
            .table-responsive {
                display: flex;
                justify-content: center;
                width: 100%;
            }

            .table {
                width: 90%;
                max-width: 100%;
                min-width: 700px;
                border-collapse: separate;
                border-spacing: 0;
                border-radius: 8px;
                overflow: hidden;
            }

            thead th {
                background-color: #1F2937 !important;
                color: white !important;
                text-align: center;
                padding: 12px;
                border-bottom: 2px solid #E5E7EB;
                position: relative;
            }

            thead input {
                width: 100%;
                padding: 6px;
                margin-top: 4px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                text-align: center;
                display: block;
            }

            tbody td {
                text-align: center;
                padding: 12px;
                border-bottom: 1px solid #E5E7EB;
            }

            tbody tr:hover {
                background-color: #F3F4F6;
            }

            .sortable:hover {
                cursor: pointer;
                text-decoration: underline;
            }

            /* Para mejorar el aspecto de la tabla */
            .filter-row th {
                background-color: #F8F9FA !important;
                padding: 10px;
            }
        </style>

        <!-- Tabla de calificaciones -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sortable" onclick="sortTable(0)">Estudiante</th>
                        <th class="sortable" onclick="sortTable(1)">Simulacro</th>
                        <th class="sortable" onclick="sortTable(2)">Fecha</th>
                        <th class="sortable" onclick="sortTable(3)">Puntaje</th>
                    </tr>
                    <tr class="filter-row">
                        <th><input type="text" class="filter-input" onkeyup="filterTable(0)"
                                placeholder="Buscar estudiante"></th>
                        <th><input type="text" class="filter-input" onkeyup="filterTable(1)"
                                placeholder="Buscar simulacro"></th>
                        <th><input type="text" class="filter-input" onkeyup="filterTable(2)" placeholder="Buscar fecha">
                        </th>
                        <th><input type="number" class="filter-input" onkeyup="filterTable(3, true)"
                                placeholder="Buscar puntaje"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($calificaciones as $calificacion)
                        <tr>
                            <td>{{ $calificacion->estudiante->name }}</td>
                            <td>{{ $calificacion->titulo_simulacro }}</td>
                            <td>{{ $calificacion->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $calificacion->puntaje }}</td>
                        </tr>
                    @empty
                        <tr class="empty-table">
                            <td colspan="4">No hay calificaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script para ordenar y filtrar columnas -->
    <script>
        function sortTable(columnIndex) {
            let table = document.querySelector("table tbody");
            let rows = Array.from(table.querySelectorAll("tr"));

            let isNumeric = columnIndex === 3; // Puntaje es numérico
            let direction = table.dataset.sortDirection === "asc" ? -1 : 1;
            table.dataset.sortDirection = direction === 1 ? "asc" : "desc";

            rows.sort((a, b) => {
                let cellA = a.children[columnIndex].innerText.trim();
                let cellB = b.children[columnIndex].innerText.trim();
                return isNumeric ? (cellA - cellB) * direction : cellA.localeCompare(cellB) * direction;
            });

            table.innerHTML = "";
            rows.forEach(row => table.appendChild(row));
        }

        function filterTable(columnIndex, exactMatch = false) {
            let input = document.querySelectorAll(".filter-input")[columnIndex];
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                let cell = row.children[columnIndex];
                if (cell) {
                    let text = cell.innerText.toLowerCase();

                    // Si el campo está vacío, mostrar todas las filas
                    if (filter === "") {
                        row.style.display = "";
                    } else if (exactMatch) {
                        row.style.display = text === filter ? "" : "none"; // Coincidencia exacta para puntaje
                    } else {
                        row.style.display = text.includes(filter) ? "" : "none";
                    }
                }
            });
        }
    </script>
@endsection
