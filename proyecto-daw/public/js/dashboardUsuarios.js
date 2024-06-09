document.addEventListener('DOMContentLoaded', function () {
    
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {

            e.preventDefault();

            const confirmado = confirm('¿Estás seguro de que quieres eliminar este producto?');

            if (confirmado) {
                form.submit(); 
            }

        });
    });
});
