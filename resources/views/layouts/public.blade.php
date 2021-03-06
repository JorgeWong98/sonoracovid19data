<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/favicon.png">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="https://kit.fontawesome.com/1d3e778218.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                @if (Auth::check())
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('dashboard/registro')}}"><i class="fas fa-search"></i> Registros</a>
                        <div class="dropdown-divider"></div>
                        <form class="dropdown-item" action="/logout" method="post">
                            @csrf
                            <i class="fas fa-sign-out-alt"></i> <input type="submit" value="Logout">
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="container-fluid">
        <div class="container">
            <div class="col-md-12">
                <span class="item">
                    <div style="margin-bottom: 15px;">Programador: <a href="https://twitter.com/JorgeLSWong" target="_blank">@JorgeLSWong</a></div>
                    <div>Colaboradora: <a href="https://www.instagram.com/patty.sotoo/" target="_blank">@Patty.sotoo</a></div>
                </span>
                <span class="item" style="display: flex; align-items: center;">
                    Fuente de datos: <a style="display: inline-block; margin-left: 5px;" href="https://datos.covid-19.conacyt.mx/" target="_blank">CONACYT</a>
                </span>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    @yield('js')
</body>
</html>
