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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body class="dashboard-body"><nav class="main-menu">
        <ul>
            <li>
                <a href="http://justinfarrow.com">
                    <i class="fa fa-gamepad fa-2x"></i>
                    <span class="nav-text">Joueur</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-group fa-2x"></i>
                    <span class="nav-text">Equipe</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-trello fa-2x"></i>
                    <span class="nav-text">Structure</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-calendar fa-2x"></i>
                    <span class="nav-text">Planing</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-gear fa-2x"></i>
                    <span class="nav-text">Paramètres</span>
                </a>
            </li>
        </ul>
        <ul class="logout">
            <li>
                <a href="#">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
