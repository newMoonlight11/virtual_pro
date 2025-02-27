@extends('layouts.user_type.auth')



@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Lista de usuarios</h3>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-secondary">+ Nuevo Usuario</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            @if ($users->isEmpty())
                                <p>No hay usuarios registrados.</p>
                            @endif
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2 text-center">Nombre
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                            Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                            Rol</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="ps-4">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-primary" style="width: 80%">{{ ucfirst($user->role) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="mx-3"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Editar usuario">
                                                    <i class="fas fa-user-edit text-success"></i>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 m-0 border-0"
                                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?');"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Eliminar usuario">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

