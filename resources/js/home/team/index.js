$(document).on('click', ".answer-team-invitation", function () {
    let invitation = $($(this).parents()[1]);
    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/answerTeamInvitation/" + invitation.data('user-role') + "/" + $(this).data('status'),
        success: function(response) {
            invitation.remove();
            if (response.status) {
                $("#teams").append("<div class=\"mr-4\">" +
                    "<a href=\"{{ route('home.team.show', " + response.newRole.team.id + ") }}\">" +
                    "<h4>" + response.newRole.team.name + "</h4>" +
                    "<p>" + response.newRole.role + "</p>" +
                    "<p>" + response.newRole.game + "</p>" +
                    "</a>" +
                    "</div>"
                )
            }
        },
    });
});