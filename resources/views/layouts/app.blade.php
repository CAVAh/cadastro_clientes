<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cadastro de Clientes') }}</title>

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
                <a class="navbar-brand" href="{{ url('/home') }}">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pais.index') }}">{{ __('País') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estado.index') }}">{{ __('Estado') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cidade.index') }}">{{ __('Cidade') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categoria.index') }}">{{ __('Categoria') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('quarto.index') }}">{{ __('Quarto') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('portador.index') }}">{{ __('Portador') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tipo_hospedagem.index') }}">{{ __('Tipo Hospedagem') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profissao.index') }}">{{ __('Profissão') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bairro.index') }}">{{ __('Bairro') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grupo_hospedagem.index') }}">{{ __('Grupo') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cliente.index') }}">{{ __('Cliente') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hospedagem.index') }}">{{ __('Hospedagem') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('footer')
</body>
</html>
