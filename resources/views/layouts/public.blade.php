<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="https://kit.fontawesome.com/1d3e778218.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">

    @yield('styles')

    <script data-ad-client="ca-pub-6022170660362952" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <title>Datos Covid-19 Sonora</title>
</head>
<body>

    <header class="container-fluid">
        <div class="container">
            <div class="col-md-12">
                <h2><a href="/ciudades">Datos Covid-19 Sonora</a></h2>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="container-fluid">
        <div class="container">
            <div class="col-md-12">
                <span class="item">
                    Pagina diseñada: <i class="fab fa-twitter-square"></i> <a href="https://twitter.com/JorgeLSWong" target="_blank">@JorgeLSWong</a>
                </span>
                <span class="item">
                    Datos recopilados de <i class="fab fa-twitter-square"></i> <a href="https://twitter.com/ssaludsonora" target="_blank">@SaludSonora</a>
                </span>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    @yield('js')
</body>
</html>
