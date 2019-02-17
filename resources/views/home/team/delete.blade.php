<div class="modal fade" id="deleteTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suppression d'équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => ['home.team.destroy', $team->id], 'method' => 'DELETE')) }}

                <p>Êtes-vous sûr de vouloir supprimer votre équipe ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                {{ Form::submit("Supprimer", ['class' => "btn btn-danger"]) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>