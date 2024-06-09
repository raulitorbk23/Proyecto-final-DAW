@extends('layouts.pago-layout')


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


    <h1 class="display-3 chakra-petch-semibold">Detalles de pago</h1>
    <section class=" d-flex justify-content-between gap-5 w-100 align-items-start ">
      <article class="w-50 ">
        <h2 class=" display-5 chakra-petch-medium">Dirección de envio</h2>
        <form id="PagoFormulario" action="" class="mb-5">

          @csrf

          @method('POST')

          <div class="mb-3">
              <label for="pais" class="form-label">Pais</label>
              <input type="text" class="form-control" id="pais" name="pais" >
              <div class="invalid-feedback">El país es requerido.</div>
          </div>
      
          <div class="mb-3">
              <label for="localidad" class="form-label">Localidad</label>
              <input type="text" class="form-control" id="localidad" name="localidad">
              <div class="invalid-feedback">La localidad es requerida.</div>
          </div>
      
          <div class="mb-3">
              <label for="codPostal" class="form-label">Código Postal</label>
              <input type="text" class="form-control" id="codPostal" name="codPostal" >
              <div class="invalid-feedback"></div>
          </div>
      
          <div class="mb-3">
              <label for="direccion" class="form-label">Direccion</label>
              <input type="text" class="form-control" id="direccion" name="direccion" >
              <div class="invalid-feedback"></div>
          </div>
      
          <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono">
              <div class="invalid-feedback"></div>
          </div>

        <h2 class=" display-5 chakra-petch-medium">Datos de tarjeta</h2>

          <div class="mb-3">
              <label for="titular" class="form-label">Titular</label>
              <input type="text" class="form-control" id="titular" name="titular" maxlength="50" required>
              <div class="invalid-feedback">El titular es requerido.</div>
          </div>
      
          <div class="mb-3">
              <label for="numTarjeta" class="form-label">Número de tarjeta</label>
              <input type="text" class="form-control" id="numTarjeta" name="numTarjeta" maxlength="20" required>
              <div class="invalid-feedback">Número de tarjeta inválido.</div>
          </div>
      
          <div class="mb-3">
              <label for="fecExpira" class="form-label">Fecha de Expiración</label>
              <input type="text" class="form-control" id="fecExpira" name="fecExpira" placeholder="MM/YY" maxlength="5" required>
              <div class="invalid-feedback">Fecha de expiración inválida.</div>
          </div>
      
          <div class="mb-3">
              <label for="cvc" class="form-label">CVC</label>
              <input type="text" class="form-control" id="cvc" name="cvc" maxlength="3" required>
              <div class="invalid-feedback">CVC inválido.</div>
          </div>

        </form>

      </article>

      <article class="w-50 ">

        <table class="table bg-transparent my-5">

          <thead>
            <tr class="border-dark">
              <th class="bg-transparent" scope="col">#</th>
              <th class="bg-transparent" scope="col">Producto</th>
              <th class="bg-transparent" scope="col">Subtotal</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($productosCarrito as $index => $item)
              <tr class="border-white">
                <th class="bg-transparent" scope="row">{{ $index + 1 }}</th>
                <td class="bg-transparent">{{ $item['nombre'] }}</td>
                <td class="bg-transparent">{{ $item['precio'] * $item['cantidad'] }} €</td>
              </tr>
            @endforeach
            
          </tbody>

          <tfoot>
            <tr class="border border-dark">
              <th class="bg-transparent" colspan="2">TOTAL</th>
              @php 
                $total = 0;
                foreach ($productosCarrito as $index => $item){
                  $total += $item['precio'] * $item['cantidad'];
                }
              @endphp
              <td class="bg-transparent">{{ $total }} €</td>
            </tr>
          </tfoot>

        </table>

        <div id="paypal-button-container" class="paypal-button-container"></div>
    
        <div id="checkout-form">
          <!-- Containers for Card Fields hosted by PayPal -->
          <div id="card-name-field-container"></div>
          <div id="card-number-field-container"></div>
          <div id="card-expiry-field-container"></div>
          <div id="card-cvv-field-container"></div>
        </div>

      </article>

    </section>
    

    <script src="{{ asset('js/pagar.js') }}">     
    </script>

@endsection

      