<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'URN') }}</title>
    <link rel="icon" href="https://i.postimg.cc/HsJtmDk0/logo.jpg" type="image/png">
    <link href="https://i.postimg.cc/HsJtmDk0/logo.jpg" type="image/png rel=" stylesheet>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'URN') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @guest

                    @else
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Productos
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('producto.index') }}"><i class="fa fa-fw fa-eye"></i> Productos</a>
                                <a class="dropdown-item " href="{{ route('categoria.index') }}"><i class="fa fa-fw fa-eye"></i> Categorias</a>
                                <a class="dropdown-item " href="{{ route('talla.index') }}"><i class="fa fa-fw fa-eye"></i> Tallas</a>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>

                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Usuarios
                            </a>


                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('user.index') }}"><i class="fa fa-fw fa-eye"></i> Usuarios</a>
                                <a class="dropdown-item " href="{{ route('rol.index') }}"><i class="fa fa-fw fa-eye"></i> Rol</a>
                                <a class="dropdown-item " href="{{ route('tipo-documento.index') }}"><i class="fa fa-fw fa-eye"></i> Tipo documento</a>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Factura
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('factura.index') }}"><i class="fa fa-fw fa-eye"></i> Factura</a>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            </div>
                        </li>

                    </ul>
                    @endguest


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))

                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ route('user.show',auth()->user()->uuid) }}"><i class="fa fa-fw fa-eye"></i> Perfil</a>
                                <a class="dropdown-item " href="{{ route('update_password') }}"><i class="fa fa-fw fa-eye"></i> Cambiar contraseña</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sessión.') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>