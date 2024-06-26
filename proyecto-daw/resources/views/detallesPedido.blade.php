@extends('layouts.pago-layout')
@section('content')
    

    <h1>Detalles del Pedido</h1>

    @if ($pedido)
        <p>Productos Pedidos:</p>
        <ul>
            @foreach ($pedido->productos as $producto)
                <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidadProducto }}</li>
            @endforeach
        </ul>
        <p>Precio Pagado: {{ $pedido->precioTotal }}</p>
        <p>Mensaje: Pago Aceptado, Pedido en Proceso</p>

        @if ($pedido->direccionEnvio)
            <p>Dirección de Envío: {{ $pedido->direccionEnvio->direccionCompleta }}</p>
        @endif

        @foreach ($pedido->pagos as $pago)
            <p>Tarjeta Utilizada: **** **** **** {{ substr($pago->tarjeta->numTarjeta, -4) }}</p>
        @endforeach
    @endif
@endsection
