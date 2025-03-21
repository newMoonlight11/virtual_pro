@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h3>Editar usuario</h3>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" autocomplete="name">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" autocomplete="email">
                @if ($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" autocomplete="phone">
                @if ($errors->has('phone'))
                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                @endif
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

                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control">
                @if ($errors->has('password'))
                    <div class="text-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="profesor" {{ $user->role == 'profesor' ? 'selected' : '' }}>Profesor</option>
                    <option value="estudiante" {{ $user->role == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                </select>
                @if ($errors->has('role'))
                    <div class="text-danger">{{ $errors->first('role') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Grupo</label>
                <select name="group" class="form-control">
                    <option value="Ninguno" {{ $user->group == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                    <option value="Sábados" {{ $user->group == 'Sábados' ? 'selected' : '' }}>Sábados</option>
                    <option value="Lunes" {{ $user->group == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                </select>
                @if ($errors->has('group'))
                    <div class="text-danger">{{ $errors->first('group') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancelar</a>
            <button type="button" class="btn btn-primary" onclick="copiarResumen()">Resumen</button>
        </form>
    </div>
    <script>
        function copiarResumen() {
            let nombre = document.querySelector('input[name="name"]').value;
            let email = document.querySelector('input[name="email"]').value;
            let telefono = document.querySelector('input[name="phone"]').value;
            let password = document.querySelector('input[name="password"]').value || "No modificada";
            let role = document.querySelector('select[name="role"]').value;
            let group = document.querySelector('select[name="group"]').value;

            let resumen = `📌 **Resumen del usuario**\n\n` +
                `👤 Nombre: ${nombre}\n` +
                `📧 Email: ${email}\n` +
                `📞 Teléfono: ${telefono}\n` +
                `🔑 Contraseña: ${password}\n` +
                `🎭 Rol: ${role}\n` +
                `🎯 Grupo: ${group}`;

            // Crear un elemento de texto temporal y copiarlo al portapapeles
            let tempInput = document.createElement("textarea");
            tempInput.value = resumen;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            alert("📋 Resumen copiado al portapapeles.");
        }
    </script>
@endsection
