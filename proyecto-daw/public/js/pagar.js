document.addEventListener("DOMContentLoaded", function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var carrito = [];

    // Lógica que maneja si el usuario posee tarjetas y direccion asociados o no
    const addTarjetaButton = document.getElementById('addTarjetaButton');
    const addDireccionButton = document.getElementById('addDireccionButton');
    const formTarjeta = document.getElementById('formTarjeta');
    const formDireccion = document.getElementById('formDireccion');

    if (addTarjetaButton && formTarjeta) {
        addTarjetaButton.addEventListener('click', function() {
            formTarjeta.classList.toggle('d-none');
        });
    }

    if (addDireccionButton && formDireccion) {
        addDireccionButton.addEventListener('click', function() {
            formDireccion.classList.toggle('d-none');
        });
    }

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
        if (!campo) return;
        
        let errorMsg = campo.nextElementSibling;
        
        if (!errorMsg || !errorMsg.classList.contains('error-message')) {
            errorMsg = document.createElement('div');
            errorMsg.classList.add('error-message');
            campo.parentNode.appendChild(errorMsg);
        }
        
        if (condicion) {
            campo.classList.remove('is-invalid');
            errorMsg.textContent = '';
        } else {
            campo.classList.add('is-invalid');
            errorMsg.textContent = mensaje;
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

    // Eventos de validación
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
        if (campo) {
            campo.addEventListener(evento, () => validarCampo(campo, validacion(campo.value), mensaje));
        }
    });

    // Validamos todos los campos
    function validarTodosCampos() {
        const isValid = campos.every(({campo, validacion}) => campo && validacion(campo.value));
        const paypalButtonContainer = document.querySelector('#paypal-button-container');
        if (paypalButtonContainer) {
            paypalButtonContainer.style.pointerEvents = isValid ? 'auto' : 'none';
            paypalButtonContainer.style.opacity = isValid ? 1 : 0.5;
        }
    }

    // Envío datos de pago
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
            style: {
                color: 'black',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: "EUR",
                            value: total.toFixed(2)
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(detalles) {
                    const selectedTarjeta = document.querySelector('input[name="tarjetaGuardada"]:checked');
                    const selectedDireccion = document.querySelector('input[name="direccionGuardada"]:checked');
        
                    let infoEnvio = {};
                    let infoTarjeta = {};
        
                    if (!selectedDireccion) {
                        infoEnvio = {
                            pais: document.getElementById('pais').value,
                            localidad: document.getElementById('localidad').value,
                            codPostal: document.getElementById('codPostal').value,
                            direccion: document.getElementById('direccion').value,
                            telefono: document.getElementById('telefono').value,
                        };
                    }
        
                    if (!selectedTarjeta) {
                        infoTarjeta = {
                            numTarjeta: document.getElementById('numTarjeta').value,
                            titular: document.getElementById('titular').value,
                            fecExpira: document.getElementById('fecExpira').value,
                            cvc: document.getElementById('cvc').value,
                        };
                    }
        
                    const requestData = {
                        detalles: detalles,
                        infoEnvio: selectedDireccion ? null : infoEnvio,
                        infoTarjeta: selectedTarjeta ? null : infoTarjeta,
                        tarjeta_id: selectedTarjeta ? selectedTarjeta.value : null,
                        direccion_id: selectedDireccion ? selectedDireccion.value : null
                    };
        
                    fetch('/webs/1A_Laravel/proyecto-daw/public/pagar', {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ data: JSON.stringify(requestData) })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        let id_pedido = data.data;
                        console.log(id_pedido);
                        window.location.href = `http://localhost/webs/1A_Laravel/proyecto-daw/public/pedido/${id_pedido}`;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            },
            onCancel: function(data) {
                console.log(data);
            }
        }).render('#paypal-button-container');
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
