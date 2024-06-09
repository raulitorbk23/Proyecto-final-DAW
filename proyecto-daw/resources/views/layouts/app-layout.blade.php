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

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        
    </head>
    <body class="chakra-petch-regular">
        <header class="container-fluid">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="col-2" id="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('/img/logo.png') }}" alt="logo de temple gym"></a>
                </div>
                <nav class="col 10 d-flex align-items-center">
                    <ul>
                        <li>
                            <a href="{{ route('index') }}">INICIO</a>
                        </li>
                        <li>
                            <a href="#">INSTALACIONES</a>
                        </li>
                        <li>
                            <a href="#">CLASES</a>
                        </li>
                        <li>
                            <a href="#">MEMBRESÍA</a>
                        </li>
                        <li>
                            <a href="#">ENCUENTRANOS</a>
                        </li>
                        <li>
                            <a href="{{ route('tienda') }}">TIENDA</a>
                        </li>
                    </ul>
                    <ul class=" d-flex align-items-center">
                        <li><a href="{{ route('login') }}"><small> INICIAR SESIÓN</small></a></li>
                        <li><a href="{{ route('user.registro') }}"><small>REGISTRARSE</small></a></li>
                    </ul>
                </nav>
            </div>
        </header>
       <main class="container d-flex flex-column justify-content-center">
            @yield('content')
        </main> 
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <footer>

        </footer>
    </body>
</html>