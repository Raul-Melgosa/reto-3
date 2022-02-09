<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IgobideApp</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @yield('assets')
    
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
</head>
<body>
    <div id="app gx-0">
        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top col-12" style="--bs-bg-opacity: .8;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    IgobideApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#layoutNavbar" aria-controls="layoutNavbar" aria-expanded="false" aria-label="Mostrar más">
                    <p class="navbar-toggler-icon m-0"></p>
                </button>

                <div class="collapse navbar-collapse" id="layoutNavbar">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @auth
                            @if(auth()->user()->rol=='operador')
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('incidencia.create') }}">
                                        {{ __('Nueva incidencia') }}
                                    </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="btn btn-link" href="/manuales"> <!--Con route('manuales.index') no estaba funcionando-->
                                        {{ __('Manuales') }}
                                    </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->email }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Registrar usuarios</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item " href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        
        <div class="separador"></div>

        <main class="py-4 row justify-content-center gx-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
