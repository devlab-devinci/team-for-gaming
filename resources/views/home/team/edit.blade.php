<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Teams update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => ['home.team.update', $team->id], 'method' => 'PATCH')) }}

                <div class="form-group">
                    {{ Form::label('name', "Nom de l'équipe") }}
                    {{ Form::text('name', $team->name, ['class' =>  "form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('game', "Jeu") }}
                    <p>{{ $team->game->name }}</p>
                </div>
                <div>
                    <p>Joueurs</p>
                    <div id="roles">
                        @foreach($usersRole as $userRole)
                            <div class="form-group">
                                @if($userRole->role->type_id != 1)
                                    {{ Form::label('roles['.$userRole->id.'][username]', $userRole->role->label) }}
                                    {{ Form::text('roles['.$userRole->id.'][username]', $userRole->user->username, ['class' =>  "form-control"]) }}

                                    <div class="form-check mt-2 mb-3">
                                        {{ Form::checkbox('roles['.$userRole->id.'][admin]', true, $userRole->admin, ['class' =>  "form-check-input"]) }}
                                        {{ Form::label('roles['.$userRole->id.'][admin]', "En tant qu'administrateur", ['class' =>
                                        "form-check-label"]) }}
                                    </div>
                                @else
                                    <p>{{ $userRole->role->label }}</p>
                                    <p>{{ $userRole->user->username }}</p>
                                @endif
                            </div>
                        @endforeach
                        <hr>
                    </div>
                    <p class="new-member">+ Ajouter un membre</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{ Form::submit("Créer", ['class' => "btn btn-primary"]) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>