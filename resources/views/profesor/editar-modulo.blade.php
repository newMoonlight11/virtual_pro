@extends('layouts.user_type.auth')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0 text-white">Editar Módulo</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profesor.actualizar_modulo', $modulo->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Necesario para Laravel, ya que los formularios no soportan PUT nativamente --}}

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $modulo->nombre) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $modulo->descripcion) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
