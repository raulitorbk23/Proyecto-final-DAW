@extends('layouts.login-layout')
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
    <div class=" d-flex justify-content-center align-items-center h-100 ">
        <form class="bg-2 p-5 w-50" method="post" action=" {{ route('user.store') }}">
            @csrf
            <h2>Registro</h2>
            <div class="mb-3">
                <label class="form-label" for="name">Nombre</label>
                <input class="form-control" type="text" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="apellidos">Apellidos</label>
                <input class="form-control" type="text" id="apellidos" name="apellidos" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Contraseña</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="c-password">Confirmar contraseña</label>
                <input class="form-control" type="password" id="c-password" name="c-password" required>
            </div>
            <div class="d-flex justify-content-center">
                <button class=" btn btn-primary" type="submit">Registrar</button>
            </div>
        </form>
    </div>
@endsection