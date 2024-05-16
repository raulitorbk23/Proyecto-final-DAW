<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TEMPLE GYM</title>

        <!--styles--> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
    </head>
    <body >
        <header class="container-fluid">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="col-2" id="logo">
                    <a href="index.php"><img src="{{ asset('/img/logo.png') }}" alt="logo de temple gym"></a>
                </div>
                <nav class="col 10">
                    <ul>
                        <li>
                            <a href="index.php">INICIO</a>
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
                            <a href="#">TIENDA</a>
                        </li>
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