@extends('layouts.user_type.auth')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0">Crear Nuevo Módulo</h5>
        </div>
        <div class="card-body">
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
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
