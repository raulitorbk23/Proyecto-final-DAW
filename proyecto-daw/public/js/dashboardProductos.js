const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener('DOMContentLoaded', function() {
    var subcategorias = window.subcategoriasData;
    console.log(subcategorias);

    var categoriaSelect = document.getElementById('id_categoria');
    var subcategoriaSelect = document.getElementById('id_subcategoria');

    categoriaSelect.addEventListener('change', function() {
        var categoria_id = categoriaSelect.value;

        // Limpiar el select de subcategorías
        subcategoriaSelect.innerHTML = '<option value="" selected disabled>Seleccione una subcategoría</option>';

        if (subcategorias[categoria_id]) {
            for (var id_subcategoria in subcategorias[categoria_id]) {
                var option = document.createElement('option');
                option.value = id_subcategoria;
                option.textContent = subcategorias[categoria_id][id_subcategoria];
                subcategoriaSelect.appendChild(option);
            }
        }
    });

    document.querySelectorAll('.stock-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var productoId = this.getAttribute('data-id');
            var nuevoStock = this.value;

            fetch('/webs/1A_Laravel/proyecto-daw/public/producto/update-stock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: productoId,
                    stock: nuevoStock
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Stock actualizado exitosamente');
                } else {
                    alert('Error al actualizar el stock');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (event) {

            event.preventDefault(); 

            const confirmado = confirm('¿Estás seguro de que quieres eliminar este producto?');

            if (confirmado) {
                form.submit(); 
            }

        });
    });

});
