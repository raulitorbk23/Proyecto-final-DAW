@extends('layouts.app-contacto-layout')

@section('content')
<div class="container mt-5">
    <div class="row gap-5 justify-content-lg-center mb-5">
        
        <div class="card mb-4 mb-md-0 col-12 col-lg-5 px-0">
            <div class="card-header bg-2 text-main-color">
                <h2>Contacto</h2>
            </div>
            <div class="card-body">
                <p><strong>Ubicación:</strong> Av. Europa 11204 Algeciras, Cádiz</p>
                <p><strong>Teléfono:</strong> +34 777 77 77 77</p>
                <p><strong>Email:</strong> contacto@templegym.com</p>
            </div>
        </div>

        <div class="card col-12 col-lg-5 px-0">
            <div class="card-header bg-2 text-main-color">
                <h2>Horarios</h2>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="membershipSelect" class="form-label">Selecciona tu membresía:</label>
                        <select class="form-select" id="membershipSelect">
                            <option value="" selected disabled>Elige una opción</option>
                            <option value="basic">Básica</option>
                            <option value="premium">Premium</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                </form>
                <div id="scheduleBasic" class="schedule d-none">
                    <h5>Horarios Básicos</h5>
                    <p><strong>Lunes a Viernes:</strong> 6:00  - 21:00 PM</p>
                    <p><strong>Sábado:</strong> 9:00 AM - 13:00 PM</p>
                    <p><strong>Domingo:</strong> Cerrado</p>
                </div>
                <div id="schedulePremium" class="schedule d-none">
                    <h5>Horarios Premium</h5>
                    <p><strong>Lunes a Viernes:</strong> 5:00  - 23:00 </p>
                    <p><strong>Sábado:</strong> 7:00  - 20:00 </p>
                    <p><strong>Domingo:</strong> 8:00  - 12:00 </p>
                </div>
                <div id="scheduleVip" class="schedule d-none">
                    <h5>Horarios VIP</h5>
                    <p><strong>Lunes a Viernes:</strong> 24 Horas</p>
                    <p><strong>Sábado y Domingo:</strong> 24 Horas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-lg-center">
        <div class="col-12 text-center">
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="{{ asset('/js/contacto.js') }}">
    
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzFb4pDp0ypBBHLH+6f5k4h6B9a5STb+4dKKPb5k4Kh+N" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-rbExVqmmy5VvKk7r3P2EMw0G/ROcASvEu1o5eJHnHd/emzzA+8WbQSO8y+2boF5T" crossorigin="anonymous"></script>

@endsection
