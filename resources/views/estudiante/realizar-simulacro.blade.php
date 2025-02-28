@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-4">Simulacro: {{ $simulacro->titulo }}</h3>
            <a href="{{ route('estudiante.simulacros') }}" class="text-end">
                <i class="bi bi-arrow-left-circle-fill text-primary fs-3"></i>
            </a>
        </div>

        <div class="row">
            <!-- Columna Izquierda: Preguntas -->
            <div class="col-md-6">
                <h5>Preguntas</h5>
                @foreach ($simulacro->preguntas as $index => $pregunta)
                    <div class="card mb-3">
                        <div class="card-body">
                            @if ($pregunta->imagen)
                                <div class="text-center">
                                    @if (filter_var($pregunta->imagen, FILTER_VALIDATE_URL))
                                        <img src="{{ $pregunta->imagen }}" alt="Imagen Pregunta" class="img-fluid rounded"
                                            style="max-width: 100%; height: auto;">
                                    @else
                                        <img src="{{ asset('storage/' . $pregunta->imagen) }}" alt="Imagen Pregunta"
                                            class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>
                            @endif
                            <h6 class="mt-3">{{ $index + 1 }}. {{ $pregunta->texto }}</h6>
                            <br>
                            <h7 class="mt-3">A. {{ $pregunta->opcion_a }}</h7>
                            <br>
                            <h7 class="mt-3">B. {{ $pregunta->opcion_b }}</h7>
                            <br>
                            <h7 class="mt-3">C. {{ $pregunta->opcion_c }}</h7>
                            <br>
                            <h7 class="mt-3">D. {{ $pregunta->opcion_d }}</h7>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Columna Derecha: Formato de Respuestas -->
            <div class="col-md-6">
                <h5>Respuestas</h5>
                <form id="form-simulacro" action="{{ route('estudiante.guardar_respuestas', $simulacro->id) }}"
                    method="POST" class="card">
                    @csrf
                    <div class="table-responsive card-body">
                        <table class="table">
                            <tbody>
                                @foreach ($simulacro->preguntas as $index => $pregunta)
                                    <tr>
                                        <td class="text-center align-middle" style="width: 40px;">{{ $index + 1 }}</td>
                                        <td class="text-center">
                                            <label class="custom-radio">
                                                <input type="radio" name="pregunta_{{ $pregunta->id }}" value="A"
                                                    required>
                                                <span class="circle">A</span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom-radio">
                                                <input type="radio" name="pregunta_{{ $pregunta->id }}" value="B">
                                                <span class="circle">B</span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom-radio">
                                                <input type="radio" name="pregunta_{{ $pregunta->id }}" value="C">
                                                <span class="circle">C</span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="custom-radio">
                                                <input type="radio" name="pregunta_{{ $pregunta->id }}" value="D">
                                                <span class="circle">D</span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <!-- Botón para enviar respuestas -->
                        <button type="submit" class="btn btn-primary mt-3" style="width: 50%">Finalizar Simulacro</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <!-- CSS Personalizado -->
    <style>
        .custom-radio input[type="radio"] {
            display: none;
        }

        .custom-radio .circle {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border: 1px solid #322e2ed1;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
            font-size: 18px;
        }

        .custom-radio input[type="radio"]:checked+.circle {
            background-color: #4b3ebf;
            color: #fff;
            border-color: white;
        }
    </style>
@endsection
