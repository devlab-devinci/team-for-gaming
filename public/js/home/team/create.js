var selectedGameId = 0;

$('select#game').change(function() {
    selectedGameId = this.value;

    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/getGameRoles/" + selectedGameId,
        success: function(roles) {
            $('select#role').html('');
            roles.forEach(function (role) {
                $('select#role').append("<option value='" + role.id + "'>" + role.label + "</option>")
            });
        },
    });
});