@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Teams create</div>

                    <div class="card-body">
                        {{ Form::open(array('route' => 'home.team.store', 'method' => 'POST')) }}

                        <div>
                            {{ Form::label('name', "Nom de l'équipe") }}
                            {{ Form::text('name') }}
                        </div>
                        <div>
                            {{ Form::label('game', "Jeu") }}
                            {{ Form::select('game', $games) }}
                        </div>
                        <div>
                            {{ Form::label('role', "Rôle") }}
                            {{ Form::select('role', $roles) }}
                        </div>
                        {{ Form::submit("Créer") }}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection