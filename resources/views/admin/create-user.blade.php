@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-secondary">
                        <h5 class="m-0 text-white">Registrar nuevo usuario</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    required autocomplete="name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    required autocomplete="email">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                    autocomplete="phone">
                                @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                                @if ($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rol</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin">Admin</option>
                                    <option value="profesor">Profesor</option>
                                    <option value="estudiante">Estudiante</option>
                                </select>
                                @if ($errors->has('role'))
                                    <div class="text-danger">{{ $errors->first('role') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Grupo</label>
                                <select name="group" class="form-control" required>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Sábados">Sábados</option>
                                    <option value="Lunes">Lunes</option>
                                </select>
                                @if ($errors->has('group'))
                                    <div class="text-danger">{{ $errors->first('group') }}</div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Registrar Usuario</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
