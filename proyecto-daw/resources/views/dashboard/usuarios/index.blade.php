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

    <div class="d-flex justify-content-start mb-3">
                
            <!-- Boton activa modal -->
        <button type="button" class="btn px-5 btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Añadir Usuario
        </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('usuario.create') }}" method="POST">
                            @csrf
                            <div class="mb-3 ">
                                <label for="name" class="form-label">Nombre</label>
                                <input placeholder="Introduce el nombre" type="text" class="form-control" id="name" name="name">
                              </div>

                              <div class="mb-3 ">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input placeholder="Introduce los apellidos del usuario" type="text" class="form-control" id="apellidos" name="apellidos">
                              </div>

                              <div class="mb-3 ">
                                <label for="email" class="form-label">Email</label>
                                <input placeholder="Introduce el email del usaurio" type="email" class="form-control" id="email" name="email">
                              </div>

                              <div class="mb-3 ">
                                <label for="password" class="form-label">Contraseña</label>
                                <input placeholder="****************" type="password" class="form-control" id="password" name="password">
                              </div>

                              <div class="mb-3 ">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" name="rol" id="rol" aria-label="Default select example">
                                    <option value="cliente" selected>cliente</option>
                                    <option value="admin">admin</option>
                                </select>
                              </div>
                            
                              <div class="d-flex flex-row justify-content-center">
                                <input type="submit" value="Crear Usuario" class="btn btn-primary btn-lg me-3 float-end">
                              </div>

                        </form>
                    </div>
                </div>
                </div>
            </div>

    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td class="text-truncate">{{ $usuario->email }}</td>
                    <td class="text-truncate">{{ $usuario->password }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td class="d-flex w-100">
                        <a href="{{ route('usuario.edit', ['usuario' => $usuario->id_usuario]) }}"><img src="{{ asset('img/edit2.jpg') }}" alt="Editar" class="acciones"></a>
                        <form class="delete-form" action="{{ route('usuario.delete', ['usuario_id' => $usuario->id_usuario]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="border-0 bg-transparent p-0" type="submit">
                                <img src="{{ asset('img/delete.jpg') }}" alt="Eliminar" class="acciones">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-5">{{ $usuarios->links() }}</div>

    <script src="{{ asset('js/dashboardUsuarios.js') }}"></script>
@endsection