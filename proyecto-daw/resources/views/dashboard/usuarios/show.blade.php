@extends('dashboard.layouts.dashboard-layout')

@section('content')

<div class="container mt-4">
    <h1 class="mb-3">Detalles del Usuario #{{ $usuario->id_usuario }}</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Información del Usuario</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td>{{ $usuario->name }}</td>
                            </tr>
                            <tr>
                                <th>Apellidos:</th>
                                <td>{{ $usuario->apellidos }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $usuario->email }}</td>
                            </tr>
                            <tr>
                                <th>Rol:</th>
                                <td>{{ $usuario->rol }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Tarjetas del Usuario</h2>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Titular</th>
                                <th>Número de Tarjeta</th>
                                <th>Fecha de Expiración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuario->tarjetas as $tarjeta)
                            <tr>
                                <td>{{ $tarjeta->titular }}</td>
                                <td>{{ $tarjeta->numTarjeta }}</td>
                                <td>{{ $tarjeta->fecExpira }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card">
                    <div class="card-header">
                        <h2>Direcciones</h2>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Pais</th>
                                    <th>Localidad</th>
                                    <th>Código Postal</th>
                                    <th>Dirección</th>
                                    <th>Télefono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuario->direcciones as $direccion)
                                <tr>
                                    <td>{{ $direccion->pais }}</td>
                                    <td>{{ $direccion->localidad }}</td>
                                    <td>{{ $direccion->codPostal }}</td>
                                    <td>{{ $direccion->direccion }}</td>
                                    <td>{{ $direccion->telefono }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>  

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Pedidos</h2>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuario->pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id_pedido }}</td>
                                <td>{{ $pedido->fecIni }}</td>
                                <td>{{ $pedido->estado }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
    </div> 

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h2>Pagos</h2>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($usuario->pagos)
                                @foreach ($usuario->pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id_pago }}</td>
                                    <td>{{ $pago->cantidad }}</td>
                                </tr>
                                @endforeach  
                            @endisset
                            @empty($usuario->pagos)
                            <tr>
                                <td colspan="2">El usuario no ha realizado ningún pago</td>
                            </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <a href="{{ route('usuario.index') }}" class="btn btn-primary">Volver a la lista de usuarios</a>
</div>
@endsection
