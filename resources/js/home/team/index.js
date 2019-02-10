$(document).on('click', ".answer-team-invitation", function () {
    console.log(window.location.origin + "/home/answerTeamInvitation/" + $($(this).parents()[1]).data('user-role') + "/" + $(this).data('status'))
    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/answerTeamInvitation/" + $($(this).parents()[1]).data('user-role') + "/" + $(this).data('status'),
        success: function() {

        },
    });
});