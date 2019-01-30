@extends('layouts.navbar')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('message') }}
            @if (session('unknownUsers'))
                <ul>
                    @foreach(session('unknownUsers') as $username)
                        <li>{{ $username }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    <h2>Teams</h2>

    <button id="create-team" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTeamModal">Créer</button>

    @include('home.team.create')
@endsection

@section('js')
    <script src="{{ asset('js/home/team/index.js') }}" defer></script>
    <script src="{{ asset('js/home/team/create.js') }}" defer></script>
@endsection