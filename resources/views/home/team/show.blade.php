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

    <h2>{{ $team->name }}</h2>
    <h3>{{ $team->game->name }}</h3>

    <div>
        @if($isAdmin)
            <button id="edit-team" type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#editTeamModal">Modifier</button>
        @endif
        @if($isCreator)
            <button id="delete-team" type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#deleteTeamModal">Supprimer</button>
        @endif

        <div id="members">
            @foreach($usersRole as $userRole)
                <div class="mr-4">
                    <p>{{ $userRole->user->username }}</p>
                    <p>{{ $userRole->role->label }}</p>
                    @if(!$userRole->status)
                        <p>En attente de validation</p>
                    @endif
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    @include('home.team.edit')
    @include('home.team.delete')
@endsection

@section('js')
    <script>
        var roles = {!! $gameRoles !!}
    </script>

    <script src="{{ asset('js/home/team/edit.js') }}" defer></script>
@endsection