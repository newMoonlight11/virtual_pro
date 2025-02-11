@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <h3>Registro de Profesores</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Registrar Nuevo Profesor</a>
        <hr>
        @include('admin.user-management')
    </div>
@endsection
