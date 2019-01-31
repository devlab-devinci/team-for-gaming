<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Teams create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'home.team.store', 'method' => 'POST')) }}

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
                        @foreach($users as $user)
                            <div class="form-group mb-2">
                                {{ Form::label('roles', $user->role->label) }}
                                {{ Form::text('roles['.$user->role->id.']', $user->user->username, ['class' =>  "form-control"]) }}
                            </div>
                        @endforeach
                        <p class="addMember">+ Ajouter un membre</p>
                    </div>
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