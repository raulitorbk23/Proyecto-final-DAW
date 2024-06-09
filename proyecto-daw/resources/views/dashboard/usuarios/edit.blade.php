@extends('dashboard.layouts.dashboard-layout')

@section('content')

    @if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('usuario.update', ['usuario' => $usuario->id_usuario]) }}" method="POST">
        
        @csrf

        @method('PUT')

        <div class="mb-3 ">
            <label for="name" class="form-label">Nombre</label>
            <input  type="text" class="form-control" id="name" name="name" value={{ $usuario->name }}>
        </div>

        <div class="mb-3 ">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input  type="text" class="form-control" id="apellidos" name="apellidos" value={{ $usuario->apellidos }}>
        </div>

        <div class="mb-3 ">
            <label for="email" class="form-label">Email</label>
            <input  type="email" class="form-control" id="email" name="email" value={{ $usuario->email }}>
        </div>

        <div class="mb-3 ">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value={{ $usuario->password }}>
        </div>

        <div class="mb-3 ">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" name="rol" id="rol" aria-label="Default select example" >
                <option value="cliente" selected>cliente</option>
                <option value="admin">admin</option>
            </select>
        </div>
        
        <div class="d-flex flex-row justify-content-center">
            <input type="submit" value="Editar Usuario" class="btn btn-primary btn-lg me-3 float-end">
        </div>

    </form>

@endsection