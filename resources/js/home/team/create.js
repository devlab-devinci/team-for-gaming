let selectedGameId = 0;
let newMembersCount = 0;

$('select#game').change(function() {
    selectedGameId = this.value;
    newMembersCount = 0;

    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/getGameRoles/" + selectedGameId,
        success: function(gameRoles) {
            roles = gameRoles;

            $('#roles').html('');
        },
    });
});

$(document).on('click', ".new-member", function () {
    newMembersCount++;
    
    let formGroupDiv = document.createElement("div");
    formGroupDiv.classList.add("form-group");

    let select = document.createElement("select");
    select.name = "roles[" + newMembersCount + "][roleId]";
    select.classList.add(...["form-control", "mb-2"]);

    roles.forEach(function (role) {
        let option = document.createElement("option");
        option.value = role.id;
        option.text = role.label;
        select.append(option);
    });

    formGroupDiv.append(select);

    let input = document.createElement("input");
    input.classList.add("form-control");
    input.name = "roles[" + newMembersCount + "][username]";
    input.type = "text";

    formGroupDiv.append(input);

    let formCheckDiv = document.createElement("div");
    formCheckDiv.classList.add(...["form-check", "mt-2", "mb-3"]);

    let radio = document.createElement("input");
    radio.classList.add("form-check-input");
    radio.name = "roles[" + newMembersCount + "][admin]";
    radio.value = 1;
    radio.type = "checkbox";

    formCheckDiv.append(radio);

    let radioLabel = document.createElement("label");
    radioLabel.classList.add("form-check-label");
    radioLabel.setAttribute('for', "roles[" + newMembersCount + "][admin]");
    radioLabel.innerHTML = "En tant qu'administrateur";

    formCheckDiv.append(radioLabel);

    formGroupDiv.append(formCheckDiv);

    $("#roles").append(formGroupDiv);
});