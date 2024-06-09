const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var carrito = [];

document.addEventListener("DOMContentLoaded", function () {

    // Campos de dirección de envío
    const pais = document.getElementById('pais');
    const localidad = document.getElementById('localidad');
    const codPostal = document.getElementById('codPostal');
    const direccion = document.getElementById('direccion');
    const telefono = document.getElementById('telefono');

    // Campos de tarjeta
    const numTarjeta = document.getElementById('numTarjeta');
    const titular = document.getElementById('titular');
    const fecExpira = document.getElementById('fecExpira');
    const cvc = document.getElementById('cvc');

    // Funciones de validación
    function validarCampo(campo, condicion, mensaje) {
        if (condicion) {
            campo.classList.remove('is-invalid');
        } else {
            campo.classList.add('is-invalid');
            campo.nextElementSibling.textContent = mensaje;
        }
        validarTodosCampos();
    }

    function validarNumTarjeta(number) {
        const regex = /^\d{16}$/;
        return regex.test(number);
    }

    function validarFechaExpiracion(fecha) {
        const regex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!regex.test(fecha)) return false;

        const hoy = new Date();
        const [month, year] = fecha.split('/').map(num => parseInt(num, 10));
        const FecExpiracion = new Date(`20${year}`, month - 1);

        return FecExpiracion >= hoy;
    }

    function validarNoVacio(value) {
        return value.trim() !== "";
    }

    function validateTelefono(value) {
        const regex = /^\d{9}$/;
        return regex.test(value);
    }

    //eventos de validación

    const campos = [
        {campo: pais, validacion: validarNoVacio, mensaje: 'El país es requerido.', evento: 'change'},
        {campo: localidad, validacion: validarNoVacio, mensaje: 'La localidad es requerida.', evento: 'change'},
        {campo: codPostal, validacion: validarNoVacio, mensaje: 'El código postal es requerido.', evento: 'change'},
        {campo: direccion, validacion: validarNoVacio, mensaje: 'La dirección es requerida.', evento: 'change'},
        {campo: telefono, validacion: validateTelefono, mensaje: 'El teléfono es requerido y debe ser de 9 dígitos.', evento: 'input'},
        {campo: numTarjeta, validacion: validarNumTarjeta, mensaje: 'Número de tarjeta inválido.', evento: 'input'},
        {campo: titular, validacion: validarNoVacio, mensaje: 'El titular es requerido.', evento: 'change'},
        {campo: fecExpira, validacion: validarFechaExpiracion, mensaje: 'Fecha de expiración inválida.', evento: 'input'},
        {campo: cvc, validacion: value => /^\d{3}$/.test(value), mensaje: 'CVC inválido.', evento: 'input'}
    ];

    campos.forEach(({campo, validacion, mensaje, evento}) => {
        campo.addEventListener(evento, () => validarCampo(campo, validacion(campo.value), mensaje));
    });

    //validamos todos los campos
    function validarTodosCampos() {
        const isValid = campos.every(({campo, validacion}) => validacion(campo.value));
        document.querySelector('#paypal-button-container').style.pointerEvents = isValid ? 'auto' : 'none';
        document.querySelector('#paypal-button-container').style.opacity = isValid ? 1 : 0.5;
    }

});

//Envio datos de pago

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

            const infoEnvio = {
                pais: pais.value,
                localidad: localidad.value,
                codPostal: codPostal.value,
                direccion: direccion.value,
                telefono: telefono.value,
            };

            const infoTarjeta = {
                numTarjeta: numTarjeta.value,
                titular: titular.value,
                fecExpira: fecExpira.value,
                cvc: cvc.value,
            }

            var URL = '/webs/1A_Laravel/proyecto-daw/public/pagar';
            fetch(URL, {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    data: JSON.stringify({
                        detalles : detalles,
                        infoEnvio : infoEnvio,
                        infoTarjeta : infoTarjeta
                    })
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log(response);
                //return response.json();
            })
            .then(data => {

            })
            .catch(error => {
                console.error('Error:', error);
            });
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

