const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
                            currency_code: "EUR",
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


