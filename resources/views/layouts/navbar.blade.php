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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body class="dashboard-body">
    <div class="sidebar">
        <div>
            <h3>User Name</h3>
        </div>
        <a class="active" href="/dashboard">Joueur</a>
        <a href="{{ route('home.team.index') }}">Équipes</a>
        <a href="{{ route('home.organisation.index') }}">Organisations</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="content">
        @yield('content')
    </div>
    @yield('js')
</body>
</html>
