@extends('layouts.tienda-layout')

@section('content')
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card">
                <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                    data-mdb-ripple-color="light">
                    <img src="{{ asset('img/'.$producto->imagen) }}"
                    class="w-100" />
                    <a href="#!">
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
                    <h6 class="mb-3">{{ $producto->id_categoria }}</h6>
                </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection