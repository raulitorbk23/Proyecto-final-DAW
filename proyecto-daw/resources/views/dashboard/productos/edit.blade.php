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

    <form action="{{ route('producto.update', ['producto' => $producto->id_producto]) }}" method="POST">
        
        @csrf

        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $producto->nombre }}">
        </div>
    
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ $producto->descripcion }}</textarea>
        </div>
    
        <div class="mb-3">
            <label for="precioCompra" class="form-label">Precio de Compra: Ej 8.99</label>
            <input type="text" class="form-control" id="precioCompra" name="precioCompra" value="{{ $producto->precioCompra }}">
        </div>
    
        <div class="mb-3">
            <label for="precioVenta" class="form-label">Precio de Venta: Ej 10.00</label>
            <input type="text" class="form-control" id="precioVenta" name="precioVenta" value="{{ $producto->precioVenta }}">
        </div>
    
        <div class="mb-3">
            <label for="descuento" class="form-label">Descuento: Ej: 5.00</label>
            <input type="text" class="form-control" id="descuento" name="descuento" value="{{ $producto->descuento }}">
        </div>
    
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-select" id="id_categoria" name="id_categoria">
                <option value="" selected disabled>Seleccione una categoría</option>
                @foreach($categorias as $id_categoria => $nombre)
                    <option value="{{ $id_categoria }}" {{ $producto->id_categoria == $id_categoria ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_subcategoria" class="form-label">Subcategoría</label>
            <select class="form-select" id="id_subcategoria" name="id_subcategoria">
                <option value="" selected disabled>Seleccione una subcategoría</option>
                @foreach($subcategorias as $id_subcategoria => $nombre)
                    <option value="{{ $id_subcategoria }}" {{ $producto->id_subcategoria == $id_subcategoria ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del Producto</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="{{ $producto->imagen }}">
        </div>
        
        <div class="d-flex flex-row justify-content-center">
            <input type="submit" value="Editar Producto" class="btn btn-primary btn-lg me-3 float-end">
        </div>

    </form>

        <script src="{{ asset('js/dashboardProductosEdit.js') }}"></script>
@endsection