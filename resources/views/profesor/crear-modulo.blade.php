@extends('layouts.user_type.auth')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0 text-white">Crear Nuevo Módulo</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('profesor.guardar_modulo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <!-- Formulario de carga de archivos -->
                <div class="mb-3">
                    <label class="form-label">Archivos</label>
                    <input type="file" name="archivos[]" class="form-control" multiple>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombres personalizados (uno por línea, opcional)</label>
                    <textarea name="nombres_personalizados" class="form-control" placeholder="Ejemplo: &#10;Mi documento 1&#10;Mi imagen 2"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('profesor.modulos') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
