@extends('layouts.user_type.auth')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Vista Previa de Preguntas</h3>

    <form action="{{ route('profesor.simulacros.store') }}" method="POST">
        @csrf
        <input type="hidden" name="titulo" value="{{ $titulo }}">
        <input type="hidden" name="descripcion" value="{{ $descripcion }}">
        <input type="hidden" name="fecha" value="{{ $fecha }}">
        <input type="hidden" name="archivo_preguntas" value="{{ $archivo }}">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th><Pregunta> Pregunta </strong></th>
                        <th><strong> Opción A </strong></th>
                        <th><strong> Opción B </strong></th>
                        <th><strong> Opción C </strong></th>
                        <th><strong> Opción D </strong></th>
                        <th><strong> Respuesta Correcta </strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preguntas as $pregunta)
                        <tr class="box_shadow">
                            <td>{{ $pregunta['texto'] }}</td>
                            <td class="text-center">{{ $pregunta['opcion_a'] }}</td>
                            <td class="text-center">{{ $pregunta['opcion_b'] }}</td>
                            <td class="text-center">{{ $pregunta['opcion_c'] }}</td>
                            <td class="text-center">{{ $pregunta['opcion_d'] }}</td>
                            <td class="text-center"><strong>{{ $pregunta['respuesta_correcta'] }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-success">Confirmar y Guardar</button>
        <a href="{{ route('profesor.simulacros.create') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>
@endsection

<style>
    .box_shadow:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.074); */
    }
</style>