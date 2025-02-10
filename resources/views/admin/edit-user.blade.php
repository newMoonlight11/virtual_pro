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
                <label class="form-label">Rol</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="profesor" {{ $user->role == 'profesor' ? 'selected' : '' }}>Profesor</option>
                    <option value="estudiante" {{ $user->role == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    </div>
@endsection
