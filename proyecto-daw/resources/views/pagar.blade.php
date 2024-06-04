
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- To be replaced with your own stylesheet -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://www.paypalobjects.com/webstatic/en_US/developer/docs/css/cardfields.css"
    />
    <!-- Express fills in the clientId variable -->
    <script src="https://www.paypal.com/sdk/js?client-id=AZggjNVZS3kMfHnm_PTUh5dzmzMuq2l4RxT4BJH3hySgTPiGR50cwNMVBTOaX7o9jE51A3rRh2IB2x4U"></script>
  </head>
  <body>
    <div id="paypal-button-container" class="paypal-button-container"></div>
    
    <div id="checkout-form">
      <!-- Containers for Card Fields hosted by PayPal -->
      <div id="card-name-field-container"></div>
      <div id="card-number-field-container"></div>
      <div id="card-expiry-field-container"></div>
      <div id="card-cvv-field-container"></div>


      <!-- To be replaced with your own Billing Address Fields -->
      <!--<div>
        <label for="card-billing-address-line-1">Billing Address</label>
        <input
          type="text"
          id="card-billing-address-line-1"
          name="card-billing-address-line-1"
          autocomplete="off"
          placeholder="Address line 1"
        >
      </div>
      <div>
        <input
          type="text"
          id="card-billing-address-line-2"
          name="card-billing-address-line-2"
          autocomplete="off"
          placeholder="Address line 2"
        >
      </div>
      <div>
        <input
          type="text"
          id="card-billing-address-admin-area-line-1"
          name="card-billing-address-admin-area-line-1"
          autocomplete="off"
          placeholder="Admin area line 1"
        >
      </div>
      <div>
        <input
          type="text"
          id="card-billing-address-admin-area-line-2"
          name="card-billing-address-admin-area-line-2"
          autocomplete="off"
          placeholder="Admin area line 2"
        >
      </div>
      <div>
        <input
          type="text"
          id="card-billing-address-country-code"
          name="card-billing-address-country-code"
          autocomplete="off"
          placeholder="Country code"
        >
      </div>
      <div>
        <input
          type="text"
          id="card-billing-address-postal-code"
          name="card-billing-address-postal-code"
          autocomplete="off"
          placeholder="Postal/zip code"
        >
      </div>
      <br><br>
      <button id="card-field-submit-button" type="button">
        Pay now with Card Fields
      </button>
    </div>-->
    <script src="{{ asset('js/pagar.js') }}">

        /*const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var carrito = [];



        fetch('/webs/1A_Laravel/proyecto-daw/public/get', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {

            console.log(data);

            carrito = data.data;

            let total = 0;
            carrito.forEach(item => {
                total += item.precio * item.cantidad;
            });

            paypal.Buttons({
            style:{
                color: 'black',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: "USD",
                            value: total.toFixed(2)
                        }
                    }]
                })
            },
            onApprove: function(data, actions){
                actions.order.capture().then(function(detalles){
                    console.log(detalles);
                });
            },
            onCancel: function(data){
                alert("pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');    

        })
        .catch(error => {
            console.error('Error:', error);
        });

        
    </script>
  </body>
</html>
      