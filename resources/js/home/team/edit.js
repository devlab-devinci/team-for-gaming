let newMembersCount = 0;

$(document).on('click', ".new-member", function () {
    newMembersCount++;

    let formGroupDiv = document.createElement("div");
    formGroupDiv.classList.add("form-group");

    let select = document.createElement("select");
    select.name = "roles[new-" + newMembersCount + "][roleId]";
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
    input.name = "roles[new-" + newMembersCount + "][username]";
    input.type = "text";

    formGroupDiv.append(input);

    let formCheckDiv = document.createElement("div");
    formCheckDiv.classList.add(...["form-check", "mt-2", "mb-3"]);

    let radio = document.createElement("input");
    radio.classList.add("form-check-input");
    radio.name = "roles[new-" + newMembersCount + "][admin]";
    radio.value = 1;
    radio.type = "checkbox";

    formCheckDiv.append(radio);

    let radioLabel = document.createElement("label");
    radioLabel.classList.add("form-check-label");
    radioLabel.setAttribute('for', "roles[new-" + newMembersCount + "][admin]");
    radioLabel.innerHTML ="En tant qu'administrateur";

    formCheckDiv.append(radioLabel);

    formGroupDiv.append(formCheckDiv);

    $("#roles").append(formGroupDiv);
});