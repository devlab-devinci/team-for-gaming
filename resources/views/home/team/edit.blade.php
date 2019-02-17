<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestion d'équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => ['home.team.update', $team->id], 'method' => 'PATCH')) }}

                <div class="form-group">
                    <h5 class="mb-3">Nom de l'équipe</h5>
                    {{ Form::text('name', $team->name, ['class' =>  "form-control"]) }}
                </div>
                <div class="form-group">
                    <h5 class="mb-3">Jeu</h5>
                    <p>{{ $team->game->name }}</p>
                </div>
                <div>
                    <h5 class="mb-3">Joueurs</h5>
                    <div id="roles">
                        @foreach($usersRole as $userRole)
                            @if($userRole->role->type_id == 1)
                                <p>{{ $userRole->role->label }}</p>
                                <p>{{ $userRole->user->username }}</p>
                                <hr>
                            @else
                                @if(!$userRole->status)
                                    <p>En attente de validation</p>
                                @endif
                                <div class="form-group d-flex">
                                    <div class="flex-column flex-fill">
                                        {{ Form::select('roles['.$userRole->id.'][roleId]', $gameRoles, $userRole->role->id, ['class' => ["pointer",
                                        "form-control", "mb-2"]]) }}
                                        {{ Form::text('roles['.$userRole->id.'][username]', $userRole->user->username, ['class' =>  "form-control"]) }}

                                        <div class="form-check mt-2 mb-3">
                                            {{ Form::checkbox('roles['.$userRole->id.'][admin]', true, $userRole->admin, ['class' =>
                                            ["pointer", "form-check-input"]]) }}
                                            {{ Form::label('roles['.$userRole->id.'][admin]', "En tant qu'administrateur", ['class' =>
                                            "form-check-label"]) }}
                                        </div>
                                    </div>
                                    <i class="remove-role pointer fa fa-times ml-3"></i>
                                </div>
                            @endif
                        @endforeach
                        <hr>
                    </div>
                    <p class="new-member pointer">+ Ajouter un membre</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                {{ Form::submit("Mettre à jour", ['class' => "btn btn-primary"]) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>