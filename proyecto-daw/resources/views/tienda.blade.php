@extends('layouts.tienda-layout')

@section('content')

    <section class="d-lg-flex d-none flex-column w-25 bg-primary vh-100 position-sticky start-0 top-0">
        <nav class="mt-5">
            <ul class="d-flex flex-column align-items-start justify-content-start">
                @foreach($scName as $item)
                    <a href="#"><li class="h3">{{ strtoupper($item) }}</li></a>
                @endforeach
            </ul>
        </nav>
    </section>
    <div class="w-75">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card">
                    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                        data-mdb-ripple-color="light">
                        <img src="{{ asset('img/'.$producto->imagen) }}"
                        class="w-100" />
                        <a href="#">
                        <div class="hover-overlay">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </div>
                        </a>
                    </div>
                    <div class="card-body">
                        <a href="" class="text-reset">
                        <h5 class="card-title mb-3">{{ $producto->nombre }}</h5>
                        </a>
                        <h6 class="mb-3">{{ $producto->precioVenta }} euros</h6>
                        
                        <div class="d-flex justify-content-center"><button class="btn btn-primary btn-lg text-center añadirCarrito">Comprar</button></div>
                    </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection