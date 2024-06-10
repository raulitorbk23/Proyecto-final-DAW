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
        

</div>

<table class="table table-striped table-hover">
<thead>
    <tr>
        <th>identificador de pedido</th>
        <th>Fecha de pedido</th>
        <th>Fecha entrega</th>
        <th>Estado</th>
        <th>Coste</th>
        <th>Usuario</th>
        <th>Direccion</th>
        <th>Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id_pedido }}</td>
            <td>{{ $pedido->fecIni }}</td>
            <td>{{ $pedido->fecFin ? $pedido->fecFin : 'pendiente' }}</td>
            <td>{{ $pedido->estado }}</td>
            <td>{{ $pedido->precioTotal }}</td>
            <td>{{ $pedido->id_usuario }}</td>
            <td>{{ $pedido->id_direccion }}</td>
                
            <td class="d-flex w-100">
                <a href="{{ route('pedido.edit', ['pedido' => $pedido->id_pedido]) }}"><img src="{{ asset('img/edit2.jpg') }}" alt="Editar" class="acciones"></a>
                <form class="delete-form" action="{{ route('pedido.delete', ['pedido_id' => $pedido->id_pedido]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="border-0 bg-transparent p-0" type="submit">
                        <img src="{{ asset('img/delete.jpg') }}" alt="Eliminar" class="acciones">
                    </button>
                </form>
                <a href="{{ route('pedido.show', ['pedido' => $pedido->id_pedido]) }}" class="btn btn-primary mx-2">MÁS</a>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
<div class="px-5">{{ $pedidos->links() }}</div>

@endsection