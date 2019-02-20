<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/jquery-ui.min.js'></script>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body class="dashboard-body">
    <nav class="main-menu">
        <ul>
            <li>
                <a href="{{ route('home.game.index') }}">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="nav-text">Joueur</span>
                </a>
            </li>
            <li>
                <a href="{{ route('home.team.index') }}">
                    <i class="fa fa-users fa-2x"></i>
                    <span class="nav-text">Équipes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-sitemap fa-2x"></i>
                    <span class="nav-text">Structures</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar-alt fa-2x"></i>
                    <span class="nav-text">Planning</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog fa-2x"></i>
                    <span class="nav-text">Paramètres</span>
                </a>
            </li>
        </ul>
        <ul class="logout">
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                    <span class="nav-text">Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="content">
        @yield('content')
    </div>
    @yield('js')
</body>
</html>
