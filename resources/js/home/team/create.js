let newMembersCount = 0;

$('select[name=game]').change(function() {
    newMembersCount = 0;

    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/getGameRoles/" + this.value,
        success: function(gameRoles) {
            roles = gameRoles;

            $.each($(".role-select"), function (index, select) {
                $(select).html("");

                $.each(roles, function (roleId, roleLabel) {
                    let option = document.createElement("option");
                    option.value = roleId;
                    option.text = roleLabel;
                    select.append(option);
                });
            })
        },
    });
});

$(document).on('click', ".new-member", function () {
    newMembersCount++;

    let formGroupDiv = document.createElement("div");
    formGroupDiv.classList.add(...["form-group", "d-flex"]);

    let formInputsDiv = document.createElement("div");
    formInputsDiv.classList.add(...["flex-column", "flex-fill"]);

    let select = document.createElement("select");
    select.name = "roles[new-" + newMembersCount + "][roleId]";
    select.classList.add(...["pointer", "role-select", "form-control", "mb-2"]);

    $.each(roles, function (roleId, roleLabel) {
        let option = document.createElement("option");
        option.value = roleId;
        option.text = roleLabel;
        select.append(option);
    });

    formInputsDiv.append(select);

    let input = document.createElement("input");
    input.classList.add("form-control");
    input.name = "roles[new-" + newMembersCount + "][username]";
    input.type = "text";

    formInputsDiv.append(input);

    let check = document.createElement("div");
    check.classList.add(...["form-check", "mt-2", "mb-3"]);

    let radio = document.createElement("input");
    radio.classList.add(...["pointer", "form-check-input"]);
    radio.name = "roles[new-" + newMembersCount + "][admin]";
    radio.value = 1;
    radio.type = "checkbox";

    check.append(radio);

    let radioLabel = document.createElement("label");
    radioLabel.classList.add("form-check-label");
    radioLabel.setAttribute('for', "roles[new-" + newMembersCount + "][admin]");
    radioLabel.innerHTML = "En tant qu'administrateur";

    check.append(radioLabel);
    formInputsDiv.append(check);
    formGroupDiv.append(formInputsDiv);

    let close = document.createElement("i");
    close.classList.add(...["remove-role", "pointer", "fa", "fa-times", "ml-3"]);

    formGroupDiv.append(close);

    $("#roles").append(formGroupDiv);
});

$(document).on('click', ".remove-role", function () {
    $(this).parent().remove();
});