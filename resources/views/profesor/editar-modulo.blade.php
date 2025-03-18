@extends('layouts.user_type.auth')

@section('content')
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="m-0 text-white">Editar Módulo</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profesor.actualizar_modulo', $modulo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $modulo->nombre) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $modulo->descripcion) }}</textarea>
                </div>

                <!-- Nuevo campo para el link de la reunión virtual -->
                <div class="mb-3">
                    <label class="form-label">Link para la reunión virtual</label>
                    <input type="url" name="link_reunion" class="form-control"
                        value="{{ old('link_reunion', $modulo->link_reunion) }}"
                        placeholder="https://meet.google.com/xxx-xxxx-xxx">
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('profesor.modulos') }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
