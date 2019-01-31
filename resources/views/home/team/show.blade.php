@extends('layouts.navbar')

@section('content')
    <h2>{{ $team->name }}</h2>
    <h3>{{ $team->game->name }}</h3>

    <div class="d-flex align-items-center">
        @foreach($users as $user)
            <div class="mr-4">
                <p>{{ $user->user->username }}</p>
                <p>{{ $user->role->label }}</p>
            </div>
        @endforeach

        <button id="edit-team" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editTeamModal">Créer</button>

        @include('home.team.edit')
    </div>
@endsection

@section('js')
    <script>
        var roles = {!! $roles !!}
    </script>

    <script src="{{ asset('js/home/team/edit.js') }}" defer></script>
@endsection