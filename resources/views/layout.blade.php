<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de treinamento</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{ route('home') }}">Sistema de treinamento</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('All courses') }}</a>
                </li>
                
                @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses') }}">{{ __('Courses') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users') }}">{{ __('Users') }}</a>
                    </li>
                @endauth
                @guest('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('My Courses') }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{ route('courses.in-progress') }}">{{ __('In progress') }}</a>
                            <a class="dropdown-item" href="{{ route('courses.concluded') }}">{{ __('Concluded') }}</a>
                        </div>
                    </li>
                @endguest
            </ul>

            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">

        @yield('main')

    </main>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
