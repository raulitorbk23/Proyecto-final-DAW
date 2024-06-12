@extends('layouts.tienda-layout')

@php
    $precioVenta = is_numeric($producto->precioVenta) ? $producto->precioVenta : 0;
    $descuento = isset($producto->descuento) && is_numeric($producto->descuento) ? $producto->descuento : 0;
    $precioFinal = $precioVenta - $descuento;
    $precioFinal = number_format($precioFinal, 2, '.', '');
@endphp

@section('content')
    <div class="row ">
        <div class="col-md-6 d-flex justify-content-center">
            <img class="img-fluid" src="{{ asset('img/'.$producto->imagen) }}" alt='imagen de {{ $producto->nombre }}'>
        </div>
        <div class="col-md-6">
            <h1 class="display-3">{{ $producto->nombre }}</h1>
            <h3 class="h2">{!! nl2br(e($producto->descripcion)) !!}</h3>
            <hr>
            <p class="h1">{{ $precioFinal }} €</p>
            <br>

        </div>
    </div>

    <script src="{{ asset('js/tienda.js') }}"></script>
@endsection