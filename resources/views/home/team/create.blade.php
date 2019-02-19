<div class="modal fade" id="createTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Création d'équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'home.team.store', 'method' => 'POST')) }}

                <div class="form-group">
                    <h5 class="mb-3">Nom de l'équipe</h5>
                    {{ Form::text('name', "", ['class' =>  "form-control"]) }}
                </div>
                <div class="form-group">
                    <h5 class="mb-3">Jeu</h5>
                    {{ Form::select('game', $games, null, ['class' =>  ["pointer", "form-control"]]) }}
                </div>
                <div>
                    <h5 class="mb-3">Joueurs</h5>
                    <div id="roles"></div>
                    <p class="new-member pointer">+ Ajouter un membre</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                {{ Form::submit("Créer", ['class' => "btn btn-primary"]) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>