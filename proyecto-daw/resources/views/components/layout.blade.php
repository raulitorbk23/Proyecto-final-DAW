<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
    </head>
    <body>
        <header>
            <div id="logo">
                <a href="index.php"><img src="{{ asset('/img/logo.png') }}" alt="logo de temple gym"></a>
            </div>
            <nav>
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
        </header>
        
    </body>
</html>