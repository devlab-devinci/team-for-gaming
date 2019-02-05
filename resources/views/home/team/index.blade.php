@extends('layouts.navbar')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning">
            {{ session('message') }}
            @if (session('unknownUsers'))
                <ul>
                    @foreach(session('unknownUsers') as $username)
                        <li>{{ $username }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <h2>Teams</h2>

    <div class="d-flex align-items-center">
        @foreach($userRoles as $userRole)
            <div class="mr-4">
                <a href="{{ route('home.team.show', $userRole->team->id) }}">
                    <p>{{ $userRole->team->name }}</p>
                    <p>{{ $userRole->role->label }}</p>
                    <p>{{ $games[$userRole->team->game_id] }}</p>
                </a>
            </div>
        @endforeach

        <button id="create-team" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTeamModal">Créer</button>

        @include('home.team.create')
    </div>
@endsection

@section('js')
    <script>
        var roles = {!! $gameRoles !!}
    </script>

    <script src="{{ asset('js/home/team/create.js') }}" defer></script>
@endsection