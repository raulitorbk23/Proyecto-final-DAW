const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function cargarSubcategorias() {
    var categoriaSelect = document.getElementById('id_categoria');
    var subcategoriaSelect = document.getElementById('id_subcategoria');

    categoriaSelect.addEventListener('change', function() {
        var categoriaId = this.value;

        // Realizar una solicitud fetch
        fetch('/webs/1A_Laravel/proyecto-daw/public/producto/obtener-subcategorias/' + categoriaId, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Error al obtener las subcategorías');
            }
            return response.json();
        })
        .then(function(data) {
            var subcategorias = data.subcategorias;

            // Limpiar las opciones actuales de subcategorías
            subcategoriaSelect.innerHTML = '';

            // Agregar las nuevas opciones de subcategorías
            for (var key in subcategorias) {
                var option = document.createElement('option');
                option.value = key;
                option.textContent = subcategorias[key];
                subcategoriaSelect.appendChild(option);
            }
        })
        .catch(function(error) {
            console.error(error);
        });
    });
}

// Activar al cargar la página
document.addEventListener('DOMContentLoaded', cargarSubcategorias());

