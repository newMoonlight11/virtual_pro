@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Registro de Estudiantes</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Registrar Nuevo Usuario</a>
        <hr>
        @include('admin.user-management') 
    </div>
@endsection
