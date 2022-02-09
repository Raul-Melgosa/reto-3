<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Igobideapp') }}</title>

    <!-- Scripts -->
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
                    {{ config('app.name', 'Laravel') }}
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
                                <a class="btn btn-link" href="{{ route('manuales.index') }}">
                                        {{ __('Manuales') }}
                                    </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end w-auto" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>
                                    @if(auth()->user()->rol=='jde')
                                    <a class="dropdown-item " href="{{ route('register') }}">
                                        Registar usuarios
                                    </a>
                                    @endif
                                    @if(auth()->user()->rol=='admin')
                                    <a class="dropdown-item " href="{{ route('register') }}">
                                        Registar usuarios
                                    </a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
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
