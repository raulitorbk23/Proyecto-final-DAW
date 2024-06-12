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
        <form class="bg-2 p-5" method="post" action=" {{ route('user.login') }}">
            @csrf
            <h2>Inicia sesión</h2>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label for="remember" class="form-check-label">Recuérdame</label>
            </div>

            <button class=" btn btn-primary" type="submit">Iniciar sesión</button>

            <div class="text-center">
                <p>No tienes cuenta? <a href="{{ route('user.registro') }}">Registrate</a></p>
            </div>

        </form>
    </div>    
@endsection
