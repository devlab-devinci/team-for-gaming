$(document).on('click', ".addMember", function () {
    var select = document.createElement("select");
    select.classList.add("addMember");

    roles.forEach(function (role) {
        var option = document.createElement("option");
        option.value = role.id;
        option.text = role.label;
        select.append(option);
    });

    $("#roles").append(select);
})