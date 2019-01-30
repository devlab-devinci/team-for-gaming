let selectedGameId = 0;
let gameRoles = {};

$('select#game').change(function() {
    selectedGameId = this.value;

    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/getGameRoles/" + selectedGameId,
        success: function(roles) {
            gameRoles = roles;

            $('#roles').html('');

            roles.forEach(function (role) {
                $('#roles').append("<label for=\"roles\">" + role.label + "</label>" +
                    "<input class=\"form-control mb-2\" name=\"roles[" + role.id + "]\" type=\"text\" value=\"\">")
            });
        },
    });
});