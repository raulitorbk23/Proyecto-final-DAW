document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('membershipSelect').addEventListener('change',showSchedule);

    function showSchedule() {
        const selectedMembership = document.getElementById('membershipSelect').value;
        const schedules = document.querySelectorAll('.schedule');
        schedules.forEach(schedule => schedule.classList.add('d-none'));

        if (selectedMembership) {
            document.getElementById(`schedule${selectedMembership.charAt(0).toUpperCase() + selectedMembership.slice(1)}`).classList.remove('d-none');
        }
    }

    function initMap() {
        // Coordenadas del centro del mapa
        var myLatLng = L.latLng(36.141714, -5.462330);

        // Crear el mapa
        var map = L.map('map').setView(myLatLng, 15); // Nivel de zoom: 15

        // Agregar una capa de mapa base
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Crear un marcador en el mapa
        L.marker(myLatLng).addTo(map)
            .bindPopup('TEMPLE GYM')
            .openPopup();
    }


    initMap();
    
})