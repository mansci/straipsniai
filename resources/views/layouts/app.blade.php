<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Straipsnių analizės informacinė sistema</title>

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
                    Straipsnių analizės informacinė sistema
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @can('viewAny', App\Models\Team::class)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('teams.index') }}">Komandos</a>
                                </li>
                            @endcan
                            @can('viewAny', App\Models\Article::class)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('teams.show', [auth()->user()->team]) }}">Straipsniai</a>
                                </li>
                            @endcan
                            @can('viewAny', App\Models\User::class)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">Naudotojai</a>
                                </li>
                            @endcan
                                @can('viewAny', App\Models\Category::class)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('categories.index') }}">Kategorijos</a>
                                    </li>
                                @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    @lang('success.' . session('success'))
                </div>
            @endif
            @if (session()->has('alert'))
                <div class="alert alert-alert" role="alert">
                    @lang('alert.' . session('alert'))
                </div>
            @endif

            <main class="py-4">
                 @yield('content')
            </main>
    </div>
</body>
</html>
