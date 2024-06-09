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
                
            <!-- Boton activar modal -->
        <button type="button" class="btn px-5 btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Añadir Producto
        </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('producto.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" >
                                </div>
                            
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                </div>
                            
                                <div class="mb-3">
                                    <label for="precioCompra" class="form-label">Precio de Compra: Ej 8.99</label>
                                    <input type="text" class="form-control" id="precioCompra" name="precioCompra" >
                                </div>
                            
                                <div class="mb-3">
                                    <label for="precioVenta" class="form-label">Precio de Venta: Ej 10.00</label>
                                    <input type="text" class="form-control" id="precioVenta" name="precioVenta" >
                                </div>
                            
                                <div class="mb-3">
                                    <label for="descuento" class="form-label">Descuento: Ej: 5.00</label>
                                    <input type="text" class="form-control" id="descuento" name="descuento" >
                                </div>
                            
                                <div class="mb-3">
                                    <label for="id_categoria" class="form-label">Categoría</label>
                                    <select class="form-select" id="id_categoria" name="id_categoria">
                                        <option value="" selected disabled>Seleccione una categoría</option>
                                        @foreach($categorias as $id_categoria => $nombre)
                                            <option value="{{ $id_categoria }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="id_subcategoria" class="form-label">Subcategoría</label>
                                    <select class="form-select" id="id_subcategoria" name="id_subcategoria">
                                        <option value="" selected disabled>Seleccione una subcategoría</option>
                                    </select>
                                </div>
                            
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">Imagen del Producto</label>
                                    <input type="text" class="form-control" id="imagen" name="imagen" value="edit2.jpg">
                                </div>
                            
                                <button type="submit" class="btn btn-primary">Crear Producto</button>
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
                <th>Descripcion</th>
                <th>Costo de producto</th>
                <th>Precio de venta</th>
                <th>Descuento</th>
                <th>id_categoria</th>
                <th>id_subcategoria</th>
                <th>stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td class="text-truncate">{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precioCompra }}</td>
                    <td>{{ $producto->precioVenta }}</td>
                    <td>{{ isset($producto->descuento) ? $producto->descuento : 'Sin descuento' }}</td>
                    <td>{{ $producto->id_categoria }}</td>
                    <td>{{ $producto->id_subcategoria }}</td>
                    <td><input type="number" value="{{ $producto->stock }}" data-id="{{ $producto->id_producto }}" class="stock-input small-input"></td>
                        
                    <td class="d-flex w-100">
                        <a href="{{ route('producto.edit', ['producto' => $producto->id_producto]) }}"><img src="{{ asset('img/edit2.jpg') }}" alt="Editar" class="acciones"></a>
                        <form class="delete-form" action="{{ route('producto.delete', ['producto_id' => $producto->id_producto]) }}" method="POST">
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
    <div class="px-5">{{ $productos->links() }}</div>
    
    <script>
        window.subcategoriasData = @json($subcategorias);
    </script>
    <script src="{{ asset('js/dashboardProductos.js') }}"></script>
@endsection