@extends('dashboard.layouts.dashboard-layout')

@section('content')

<div class="container mt-4">
    <h1 class="mb-3">Detalles del Pedido #{{ $pedido->id_pedido }}</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Información del Pedido
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Fecha de Pedido:</th>
                            <td>{{ $pedido->fecIni }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Entrega:</th>
                            <td>{{ $pedido->fecFin ? $pedido->fecFin : 'Pendiente' }}</td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>{{ $pedido->estado }}</td>
                        </tr>
                        <tr>
                            <th>Coste:</th>
                            <td>{{ $pedido->precioTotal }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Información del Usuario
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nombre del Usuario:</th>
                            <td>{{ $pedido->usuario->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellido del Usuario:</th>
                            <td>{{ $pedido->usuario->apellidos }}</td>
                        </tr>
                        <tr>
                            <th>Email del Usuario:</th>
                            <td>{{ $pedido->usuario->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Información de la Dirección
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Pais:</th>
                            <td>{{ $pedido->direccionEnvio->pais }}</td>
                        </tr>
                        <tr>
                            <th>Localidad:</th>
                            <td>{{ $pedido->direccionEnvio->localidad }}</td>
                        </tr>
                        <tr>
                            <th>Código Postal:</th>
                            <td>{{ $pedido->direccionEnvio->codPostal }}</td>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <td>{{ $pedido->direccionEnvio->direccion }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Información de los Productos
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->productos as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->pivot->cantidadProducto }}</td>
                                    <td>{{ $producto->pivot->precioProducto }} €</td>
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
                    Información de los Pagos
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID del Pago</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id_pago }}</td>
                                    <td>{{ $pago->cantidad }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('pedido.index') }}" class="btn btn-primary">Volver a la lista de pedidos</a>
</div>

@endsection
