const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// JavaScript para manejar el carrito 

document.addEventListener('DOMContentLoaded', function() {
    const botonCarrito = document.getElementById('botonCarrito');
    const cerrarCarrito = document.getElementById('cerrarCarrito');
    const carritoDiv = document.getElementById('carrito');
    const productosCarrito = document.getElementById('productosCarrito');
    const precioCarrito = document.getElementById('precioCarrito');

    let carrito = [];

    // Mostrar el carrito offcanvas
    botonCarrito.addEventListener('click', function() {
        carritoDiv.classList.add('abierto');
    });

    // Cerrar el carrito offcanvas
    cerrarCarrito.addEventListener('click', function() {
        carritoDiv.classList.remove('abierto');
    });

    // Función para agregar producto al carrito
    function añadirProductoCarrito(product) {
        fetch('/webs/1A_Laravel/proyecto-daw/public/tienda/guardar-en-carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                nombre: product,
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {

            //si el producto ya existe en el carrito aumento la cantidad
            let existingProduct = carrito.find(item => item.nombre === data.nombre);
            if (existingProduct) {
                existingProduct.cantidad += 1;
            } else {
                //si no existe cambio la cantidad de null a 1 y lo añado
                data.cantidad = 1;
                carrito.push(data);
            }
            renderCart();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Función para renderizar los elementos del carrito
    function renderCart() {
        productosCarrito.innerHTML = '';
        carrito.forEach(item => {
            let li = document.createElement('li');
            li.classList.add('my-2', 'd-flex', 'align-items-center', 'justify-content-between');

            let img = document.createElement('img');
            img.src = `http://localhost/webs/1A_Laravel/proyecto-daw/public/img/${item.img}`;
            img.style.width = '50px';
            img.style.height = '50px';
            img.classList.add('me-3');

            let cantidad = document.createElement('input');
            cantidad.type = 'number';
            cantidad.min = '1'; 
            cantidad.value = `${item.cantidad}`;
            cantidad.style.width = '100px';
            cantidad.classList.add('producto-cantidad', 'mx-2', 'float-end');
            
            cantidad.addEventListener('input', function() {
                item.cantidad = parseInt(cantidad.value);
                actualizarTotal();
            });

            let nombre = document.createElement('span');
            nombre.classList.add('mx-2');
            nombre.textContent = item.nombre;
            nombre.classList.add('producto-nombre');

            let texto = document.createTextNode(`$${item.precio}`);

            let eliminarBtn = document.createElement('button');
            eliminarBtn.textContent = 'X';
            eliminarBtn.classList.add('btn', 'btn-danger', 'mx-2', 'float-end');
            eliminarBtn.addEventListener('click', function() {
                carrito = carrito.filter(item => item.nombre !== nombre.textContent);
                renderCart();
            });

            let divDescription = document.createElement('div');
            divDescription.classList.add('float-end');
            divDescription.appendChild(cantidad);
            divDescription.appendChild(eliminarBtn);

            let divUnits = document.createElement('div');
            divUnits.appendChild(img);
            divUnits.appendChild(nombre);
            divUnits.appendChild(texto);

            li.appendChild(divUnits);
            li.appendChild(divDescription);

            productosCarrito.appendChild(li);
        });

        actualizarTotal();
    }

    // Función para calcular el precio total de los elementos del carrito
    function actualizarTotal() {
        let total = 0;
        carrito.forEach(item => {
            total += item.precio * item.cantidad;
        });
        precioCarrito.textContent = total.toFixed(2);
    }


    document.addEventListener('click', function(e){

        //evento recoge el click en el boton comprar de todos los productos que se generen dinamicamente
        if(e.target.classList.contains('añadirCarrito')){
            let nomProducto = e.target.offsetParent.children[1].children[0].children[0].innerHTML;
            console.log(nomProducto);
            añadirProductoCarrito(nomProducto);
        }
    })

});
