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
        <div id="teams" class="d-flex">
            @foreach($teams as $userRoles)
                @foreach($userRoles as $userRole)
                    @if($userRole->status)
                        <div class="mr-4">
                            <a href="{{ route('home.team.show', $userRole->team->id) }}">
                                <h4>{{ $userRole->team->name }}</h4>
                                <p>{{ implode(" - ", $userRoles->pluck('role_label')->all()) }}</p>
                                <p>{{ $games[$userRole->team->game_id] }}</p>
                            </a>
                        </div>
                        @break
                    @endif
                @endforeach
            @endforeach
        </div>

        <button id="create-team" type="button" class="btn btn-primary mx-3" data-toggle="modal" data-target="#createTeamModal">Créer</button>
    </div>

    <div class="mt-5">
        <h3>Invitations</h3>
        @foreach($teams as $userRoles)
            @foreach($userRoles as $userRole)
                @if(!$userRole->status)
                    <div class="mr-4" data-user-role="{{ $userRole->id }}">
                        <h4>
                            {{ $userRole->team->name }} - {{ $userRole->role->label }}
                            <i class="answer-team-invitation fa fa-check" data-status="1"></i>
                            <i class="answer-team-invitation fa fa-times" data-status="0"></i>
                        </h4>
                    </div>
                @endif
            @endforeach
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