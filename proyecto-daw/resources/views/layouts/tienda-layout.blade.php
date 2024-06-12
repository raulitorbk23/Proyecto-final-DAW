<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TEMPLE GYM - TIENDA</title>

        <!--styles--> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

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
              <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav d-flex flex-wrap justify-content-lg-start justify-content-lg-start align-items-center list-inline">
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.novedades') }}">NOVEDADES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.suplementos') }}">SUPLEMENTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.ropa') }}">ROPA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.accesorios') }}">ACCESORIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.calzado') }}">CALZADO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-a p-2 p-lg-2 mx-1 my-2 my-lg-0" href="{{ route('tienda.ofertas') }}">OFERTAS</a>
                    </li>
                </ul>
                
              </div>
              <ul class="navbar-nav d-flex flex-nowrap justify-content-start list-inline">
                    <li><button type="button" id="botonCarrito" type="button" class="btn position-relative">
                        <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M1.28869 2.76282C1.41968 2.36986 1.84442 2.15749 2.23737 2.28848L2.50229 2.37678C2.51549 2.38118 2.52864 2.38557 2.54176 2.38994C3.16813 2.59871 3.69746 2.77513 4.11369 2.96876C4.55613 3.17459 4.94002 3.42968 5.23112 3.83355C5.52221 4.23743 5.64282 4.68229 5.69817 5.16711C5.75025 5.62321 5.75023 6.18117 5.7502 6.84142L5.7502 9.49999C5.7502 10.9354 5.7518 11.9365 5.85335 12.6919C5.952 13.4256 6.13245 13.8142 6.40921 14.091C6.68598 14.3677 7.07455 14.5482 7.80832 14.6468C8.56367 14.7484 9.56479 14.75 11.0002 14.75H18.0002C18.4144 14.75 18.7502 15.0858 18.7502 15.5C18.7502 15.9142 18.4144 16.25 18.0002 16.25H10.9453C9.57774 16.25 8.47542 16.25 7.60845 16.1335C6.70834 16.0125 5.95047 15.7536 5.34855 15.1516C4.74664 14.5497 4.48774 13.7918 4.36673 12.8917C4.25017 12.0248 4.25018 10.9225 4.2502 9.55487L4.2502 6.88303C4.2502 6.17003 4.24907 5.69826 4.20785 5.33726C4.16883 4.99541 4.10068 4.83052 4.01426 4.71062C3.92784 4.59072 3.79296 4.47392 3.481 4.3288C3.15155 4.17554 2.70435 4.02527 2.02794 3.79981L1.76303 3.7115C1.37008 3.58052 1.15771 3.15578 1.28869 2.76282Z" fill="#1C274C"></path> <path opacity="0.5" d="M5.74512 5.99997C5.75008 6.25909 5.75008 6.53954 5.75007 6.84137L5.75006 9.49997C5.75006 10.9354 5.75166 11.9365 5.85321 12.6918C5.86803 12.8021 5.8847 12.9045 5.90326 13H16.0221C16.9815 13 17.4612 13 17.8369 12.7522C18.2126 12.5045 18.4016 12.0636 18.7795 11.1817L19.2081 10.1817C20.0176 8.29291 20.4223 7.3485 19.9777 6.67423C19.5331 5.99997 18.5056 5.99997 16.4507 5.99997H5.74512Z" fill="#1C274C"></path> <path d="M7.25 9C7.25 8.58579 7.58579 8.25 8 8.25H11C11.4142 8.25 11.75 8.58579 11.75 9C11.75 9.41421 11.4142 9.75 11 9.75H8C7.58579 9.75 7.25 9.41421 7.25 9Z" fill="#1C274C"></path> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#1C274C"></path> <path d="M18 19.5001C18 18.6716 17.3284 18.0001 16.5 18.0001C15.6716 18.0001 15 18.6716 15 19.5001C15 20.3285 15.6716 21.0001 16.5 21.0001C17.3284 21.0001 18 20.3285 18 19.5001Z" fill="#1C274C"></path> </g></svg>
                    </button></li>
            </ul>
            </div>
            
          </nav>
        
       <main class="container w-100 d-flex justify-content-between gap-5 my-5">

            @yield('content')
            
        </main> 
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <footer class="py-4 bg-dark text-white text-center mt-auto w-100">
            <div class="container">
                <p><a href="{{ route('Copyright') }}">&copy;</a> 2024 Temple Gym. Todos los derechos reservados.</p>
                <div class="d-flex justify-content-center">
                    <div class="row">
                        <p class="col text-md-end"><a href="{{ route('PoliticasPrivacidad') }}">Política de Privacidad</a> | <a href="{{ route('TerminosCondiciones') }}">Términos y Condiciones</a></p>
                        <p class="col text-md-start"><a href="{{ route('PoliticasCookies') }}">Política de Cookies</a> | <a href="{{ route('AvisoLegal') }}"> Aviso Legal</a></p>
                        <p class="col text-md-start"><a href="{{ route('Devoluciones') }}">Política de Cookies</a> | <a href="{{ route('PoliticasEnvio') }}"> Aviso Legal</a></p>
                    </div>
                </div>
                <p>Síguenos en <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-instagram"></i></a></p>
            </div>
        </footer>
    </body>
</html>