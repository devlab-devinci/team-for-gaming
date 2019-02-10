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
                    <h4>{{ $userRole->team->name }}</h4>
                    <p>{{ $userRole->role->label }}</p>
                    <p>{{ $games[$userRole->team->game_id] }}</p>
                </a>
            </div>
        @endforeach

        <button id="create-team" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTeamModal">Créer</button>
    </div>

    <div class="mt-5">
        <h3>Invitations</h3>
        @foreach($pendingUserRoles as $pendingUserRole)
            <div class="mr-4" data-user-role="{{ $pendingUserRole->id }}">
                <h4>
                    {{ $pendingUserRole->team->name }}
                    <i class="fa fa-check answer-team-invitation" data-status="1"></i>
                    <i class="fa fa-times answer-team-invitation" data-status="0"></i>
                </h4>
            </div>
        @endforeach
    </div>

    @include('home.team.create')
@endsection

@section('js')
    <script>
        var roles = {!! $gameRoles !!}
    </script>

    <script src="{{ asset('js/home/team/index.js') }}" defer></script>
    <script src="{{ asset('js/home/team/create.js') }}" defer></script>
@endsection