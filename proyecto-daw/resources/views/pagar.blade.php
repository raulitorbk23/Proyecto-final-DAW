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
        <div class="mb-4">
          <h4>Tarjetas Guardadas</h4>
          @if($tarjetas->isEmpty())
              <p>No tienes tarjetas guardadas.</p>
          @else
              <div class="form-group">
                  @foreach($tarjetas as $tarjeta)
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="tarjetaGuardada" id="tarjeta{{ $tarjeta->id_tarjeta }}" value="{{ $tarjeta->id_tarjeta }}">
                          <label class="form-check-label" for="tarjeta{{ $tarjeta->id_tarjeta }}">
                              {{ $tarjeta->numTarjeta }} - {{ $tarjeta->titular }} - {{ $tarjeta->fecExpira }}
                          </label>
                      </div>
                  @endforeach
              </div>
          @endif
          <button id="addTarjetaButton" class="btn btn-primary">Añadir Nueva Tarjeta</button>
      </div>
  
      <div class="mb-4">
          <h4>Direcciones Guardadas</h4>
          @if($direcciones->isEmpty())
              <p>No tienes direcciones guardadas.</p>
          @else
              <div class="form-group">
                  @foreach($direcciones as $direccion)
                      <div class="form-check">
                          <input class="form-check-input" type="radio" name="direccionGuardada" id="direccion{{ $direccion->id_direccion }}" value="{{ $direccion->id_direccion }}">
                          <label class="form-check-label" for="direccion{{ $direccion->id_direccion }}">
                              {{ $direccion->pais }}, {{ $direccion->localidad }}, {{ $direccion->codPostal }}, {{ $direccion->direccion }}, {{ $direccion->telefono }}
                          </label>
                      </div>
                  @endforeach
              </div>
          @endif
          <button id="addDireccionButton" class="btn btn-primary">Añadir Nueva Dirección</button>
      </div>
  
      <div id="formTarjeta" class="d-none">
          <h2>Datos de tarjeta</h2>
          <form>
            
            @csrf
            @method('POST')
            
            <div class="mb-3">
                <label for="titular" class="form-label">Titular</label>
                <input type="text" class="form-control" id="titular" name="titular" maxlength="50" required>
            </div>
            
            <div class="mb-3">
                <label for="numTarjeta" class="form-label">Número de tarjeta</label>
                <input type="text" class="form-control" id="numTarjeta" name="numTarjeta" maxlength="20" required>
            </div>
            
            <div class="mb-3">
                <label for="fecExpira" class="form-label">Fecha de Expiración</label>
                <input type="text" class="form-control" id="fecExpira" name="fecExpira" placeholder="MM/YY" maxlength="5" required>
            </div>
            
            <div class="mb-3">
                <label for="cvc" class="form-label">CVC</label>
                <input type="text" class="form-control" id="cvc" name="cvc" maxlength="3" required>
            </div>
              
          </form>
      </div>
  
      <div id="formDireccion" class="d-none">
          <h2>Datos de dirección de envío</h2>
          <form>

            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="pais" class="form-label">Pais</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>

            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" id="localidad" name="localidad" required>
            </div>

            <div class="mb-3">
                <label for="codPostal" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="codPostal" name="codPostal" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>   
             
          </form>
      </div>

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
                <th class="bg-transparent" scope="row">{{ is_integer($index) ? $index + 1 : '' }}</th>
                <td class="bg-transparent">{{is_array($item) || is_object($item) ? $item['nombre'] : 'No hay productos en el carrito'}}</td>
                <td class="bg-transparent">{{is_array($item) || is_object($item) ? $item['precio'] * $item['cantidad'] : 0}} €</td>
              </tr>
            @endforeach
            
          </tbody>

          <tfoot>
            <tr class="border border-dark">
              <th class="bg-transparent" colspan="2">TOTAL</th>
              @php
                $total = 0;
                if (is_array($productosCarrito) || $productosCarrito instanceof \Illuminate\Support\Collection) {
                    foreach ($productosCarrito as $item) {
                        if (is_array($item)) {
                            $total += $item['precio'] * $item['cantidad'];
                        } elseif (is_object($item)) {
                            $total += $item->precio * $item->cantidad;
                        }
                    }
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

      