<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TEMPLE GYM</title>

        <!--styles--> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        
    </head>
    
    <body class="chakra-petch-regular">
        <nav class="navbar navbar-expand-lg container-fluid bg-2" data-bs-theme="dark">
            <div class="container">
                <div class="col-2" id="logo">
                    <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('/img/logo.png') }}" alt="logo de temple gym"></a>
                </div>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse  w-60" id="navbarColor01">
                <ul class="navbar-nav d-flex flex-wrap justify-content-lg-start justify-content-lg-start align-items-center list-inline">
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('index') }}">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('clases') }}">CLASES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('contacto') }}">ENCUENTRANOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda') }}">TIENDA</a>
                    </li>
                    <li class="nav-item"><a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('login') }}"><small> INICIAR SESIÓN</small></a></li>
                </ul>
                <ul class="navbar-nav d-flex flex-nowrap justify-content-start list-inline">
                </ul>
              </div>
            </div>
          </nav>
        <div class="hero ">
            <img src="{{ asset('img/encuentranos.jpeg') }}" alt="Encuéntranos" class="hero-img">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="display-3 chakra-petch-semibold">¡Bienvenido a Nuestro Gimnasio!</h1>
                <p class="lead chakra-petch-semibold">Donde los dioses entrenan</p>
            </div>
        </div>
        
       <main class="container d-flex flex-column justify-content-center my-5">
            @yield('content')
        </main> 
        
        <footer class="py-4 bg-dark text-white text-center mt-auto w-100">
            <div class="container">
                <p><a href="{{ route('Copyright') }}">&copy;</a> 2024 Temple Gym. Todos los derechos reservados.</p>
                <div class="d-flex justify-content-center">
                    <div class="row">
                        <p class="col text-md-end"><a href="{{ route('PoliticasPrivacidad') }}">Política de Privacidad</a> | <a href="{{ route('TerminosCondiciones') }}">Términos y Condiciones</a></p>
                        <p class="col text-md-start"><a href="{{ route('PoliticasCookies') }}">Política de Cookies</a> | <a href="{{ route('AvisoLegal') }}"> Aviso Legal</a></p>
                    </div>
                </div>
                <p>Síguenos en <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-instagram"></i></a></p>
            </div>
        </footer>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>