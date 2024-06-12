@extends('layouts.tienda-layout')

@section('content')

<section class="d-lg-flex d-none flex-column w-25 bg-3 vh-100 position-sticky start-0 top-0">
    <nav class="mt-5">
        <ul class="d-flex flex-column align-items-start justify-content-start me-lg-5 me-xl-0">
            @foreach ($scName as $id_subcategoria => $nombre)
                <a href="{{ route('tienda.filtrarPorSubcategoria', ['id_subcategoria' => $id_subcategoria]) }}">
                    <li class=" subcategorias p-1 underline-effect text-dark list-inline ">
                        {{ strtoupper($nombre) }}
                    </li>
                </a>
            @endforeach
        </ul>
    </nav>
</section>
<div class="w-100 ">
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                        <a href="{{ route('tienda.show', ['producto' => $producto->nombre]) }}">
                            <img src="{{ asset('img/'.$producto->imagen) }}" class="w-100" />
                            <div class="hover-overlay">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </div>
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="" class="text-reset">
                            <h5 class="card-title text-center text-lg-start mb-3">{{ $producto->nombre }}</h5>
                        </a>
                        <h6 class="mb-3 text-center text-lg-start">{{ isset($producto->descuento) ? $producto->precioVenta - $producto->descuento : $producto->precioVenta }} euros</h6>
                        @guest
                            <div class="d-flex justify-content-center"><a class="btn btn-primary btn-lg text-center" href="{{ route('user.login') }}">Comprar</a></div>
                        @endguest
                        @auth
                            <div class="d-flex justify-content-center"><button class="btn btn-primary btn-lg text-center añadirCarrito">Comprar</button></div>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="">{{ $productos->links() }}</div>
</div>
<div id="carrito" class="carrito">
    <div class="carrito-header">
        <h2>Carrito</h2>
        <button id="cerrarCarrito" class="btn btn-close p-3"></button>
    </div>
    <div class="carrito-body">
        <!-- Aquí se mostrarán los productos del carrito -->
        <ul id="productosCarrito">
        </ul>
    </div>
    <div class="carrito-footer">
        <strong>Total: €<span id="precioCarrito">0.00</span></strong>
    </div>
    <form action="{{ route('pagar.carrito') }}">
        <button class="btn btn-primary btn-lg float-end" id="comprarBtn">Pagar</button>
    </form>
</div>

<script src="{{ asset('js/tienda.js') }}"></script>
@endsection
