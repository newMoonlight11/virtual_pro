@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h3>Editar usuario</h3>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Ubicación</label>
                <input type="text" name="location" value="{{ $user->location }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Sobre mí</label>
                <textarea name="about_me" class="form-control">{{ $user->about_me }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nueva Contraseña <small>(Opcional)</small></label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y
                    caracteres especiales.</small>
                @error('password')
                    <div class="alert alert-danger mt-2">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="profesor" {{ $user->role == 'profesor' ? 'selected' : '' }}>Profesor</option>
                    <option value="estudiante" {{ $user->role == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
