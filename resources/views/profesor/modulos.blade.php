@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Gestión de Módulos</h3>
        <a href="{{ route('profesor.crear_modulo') }}" class="btn btn-primary">+ Nuevo Módulo</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nombre }}</td>
                        <td>{{ $modulo->descripcion }}</td>
                        <td>
                            <a href="{{ route('profesor.editar_modulo', $modulo->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('profesor.eliminar_modulo', $modulo->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este módulo?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
