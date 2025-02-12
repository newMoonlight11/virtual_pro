@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Crear Nuevo Módulo</h3>
        <form action="{{ route('profesor.guardar_modulo') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
