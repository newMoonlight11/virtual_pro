@extends('layouts.user_type.auth')

@section('content')
    <meta name="referrer" content="no-referrer">
    <div class="container py-4 card">
        <h3 class="mb-4">Vista Previa de Preguntas</h3>

        <form action="{{ route('profesor.simulacros.store') }}" method="POST" class="card-body">
            @csrf
            <input type="hidden" name="titulo" value="{{ session('titulo') }}">
            <input type="hidden" name="descripcion" value="{{ session('descripcion') }}">
            <input type="hidden" name="fecha" value="{{ session('fecha') }}">
            <input type="hidden" name="hora_fin" value="{{ session('hora_fin') }}">
            <input type="hidden" name="archivo_preguntas" value="{{ session('archivo') }}">


            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th><strong> Imagen</strong></th>
                            <th><strong> Pregunta </strong></th>
                            <th><strong> Opción A </strong></th>
                            <th><strong> Opción B </strong></th>
                            <th><strong> Opción C </strong></th>
                            <th><strong> Opción D </strong></th>
                            <th><strong> Respuesta Correcta </strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas as $pregunta)
                            <tr>
                                <td class="text-center">
                                    @if (filter_var($pregunta['imagen'], FILTER_VALIDATE_URL))
                                        <img src="{{ $pregunta['imagen'] }}" alt="Imagen Pregunta" width="50">
                                    @elseif($pregunta['imagen'])
                                        <img src="{{ asset('storage/' . $pregunta['imagen']) }}" alt="Imagen Pregunta"
                                            width="50">
                                    @else
                                        <span class="text-muted">No imagen</span>
                                    @endif
                                </td>
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
            <br>
            <button type="submit" class="btn btn-success">Confirmar y Guardar</button>
            <a href="{{ route('profesor.simulacros.create') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection

<style>
    .box_shadow:hover {
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.074);
        */
    }
</style>
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Evita la recarga

        let form = this;
        let formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href =
                    "{{ route('profesor.simulacros.preview') }}"; // Redirige sin perder datos
                }
            })
            .catch(error => console.error(error));
    });
</script>
