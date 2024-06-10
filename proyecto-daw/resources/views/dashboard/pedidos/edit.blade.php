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

<form action="{{ route('pedido.update', ['pedido' => $pedido->id_pedido]) }}" method="POST">

    @csrf

    @method('PUT')

    <div class="mb-3">
        <label for="fecIni" class="form-label">Fecha de Pedido</label>
        <input type="date" class="form-control" id="fecIni" name="fecIni" value="{{ $pedido->fecIni }}">
    </div>

    <div class="mb-3">
        <label for="fecFin" class="form-label">Fecha de Entrega</label>
        <input type="date" class="form-control" id="fecFin" name="fecFin" value="{{ $pedido->fecFin }}">
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="{{ $pedido->estado }}">
    </div>

    <div class="mb-3">
        <label for="precioTotal" class="form-label">Coste</label>
        <input type="text" class="form-control" id="precioTotal" name="precioTotal" value="{{ $pedido->precioTotal }}">
    </div>

    <div class="mb-3">
        <label for="id_direccion" class="form-label">Dirección</label>
        <select class="form-select" id="id_direccion" name="id_direccion">
            <option value="" selected disabled>Seleccione una dirección</option>
            @foreach($direcciones as $id_direccion => $direccion)
                <option value="{{ $id_direccion }}" {{ $pedido->id_direccion == $id_direccion ? 'selected' : '' }}>{{ $direccion }}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex flex-row justify-content-center">
        <input type="submit" value="Editar Pedido" class="btn btn-primary btn-lg me-3 float-end">
    </div>
</form>

@endsection
