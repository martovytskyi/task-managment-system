<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/sass/main.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
                <span class="name">
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <li class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                {{ Breadcrumbs::render() }}

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Language Switcher -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ strtoupper(app()->getLocale()) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @foreach(config('app.supported_locales') as $locale => $localeName)
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); setLocale('{{ $locale }}');">
                                    {{ $localeName }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('lang.login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('lang.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item item-logout">
                            <a class="dropdown-item logout" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<script>
    function setLocale(locale) {
        axios.post('{{ route('set.locale', ['locale' => ':locale']) }}'.replace(':locale', locale))
            .then(() => location.reload())
            .catch(error => console.log(error));
    }
    (function () {
        'use strict';
        window.addEventListener('load', () => {
            const forms = document.getElementsByClassName('needs-validation');
            for (const form of forms) {
                form.addEventListener('submit', (event) => {
                    form.classList.add('was-validated');
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        const formId = form.id;
                        document.getElementById(formId).submit();
                    }
                }, false);
            }
        }, false);
    })();
</script>
</body>
</html>
