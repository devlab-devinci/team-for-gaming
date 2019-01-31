<div class="modal fade" id="createTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    {{ Form::text('name', "", ['class' =>  "form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('game', "Jeu") }}
                    {{ Form::select('game', $games, null, ['class' =>  "form-control"]) }}
                </div>
                <div>
                    <p>Joueurs</p>
                    <div id="roles">
                        @foreach($roles as $role)
                            <div class="form-group mb-2">
                                {{ Form::label('roles', $role->label) }}
                                {{ Form::text('roles['.$role->id.']', "", ['class' =>  "form-control"]) }}
                            </div>
                        @endforeach
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