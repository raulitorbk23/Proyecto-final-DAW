
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
    <script src="https://www.paypal.com/sdk/js?client-id=AZggjNVZS3kMfHnm_PTUh5dzmzMuq2l4RxT4BJH3hySgTPiGR50cwNMVBTOaX7o9jE51A3rRh2IB2x4U&currency=EUR"></script>
  </head>
  <body>
    <div id="paypal-button-container" class="paypal-button-container"></div>
    
    <div id="checkout-form">
      <!-- Containers for Card Fields hosted by PayPal -->
      <div id="card-name-field-container"></div>
      <div id="card-number-field-container"></div>
      <div id="card-expiry-field-container"></div>
      <div id="card-cvv-field-container"></div>


    <script src="{{ asset('js/pagar.js') }}">

     
    </script>
  </body>
</html>
      