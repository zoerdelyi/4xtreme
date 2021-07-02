$(document).ready(function () {
    var formInputs = {
        name: {
            label: "Név:",
            type: "text",
            id: "name",
            placeholder: "Fix Ipszilon",
            class: "form-control"
        },
        password: {
            label: "Jelszó:",
            type: "password",
            id: "password",
            placeholder: "",
            class: "form-control"
        },
        passwordConfirm: {
            label: "Jelszó újra:",
            type: "password",
            id: "passwordConfirm",
            placeholder: "",
            class: "form-control"
        },
        // bornDate: {
        //     label: "Születési idő:",
        //     type: "text",
        //     id: "bornDate",
        //     placeholder: "1999.02.02.",
        //     class: "form-control"
        // },
        // sex: {
        //     label: "Neme:",
        //     type: "select",
        //     id: "sex",
        //     options: "",
        //     class: "form-control"
        // },
        email: {
            label: "E-mail:",
            type: "email",
            id: "email",
            placeholder: "email@email.hu",
            class: "form-control"
        }
        // telephone: {
        //     label: "Tel.:",
        //     type: "text",
        //     id: "telephone",
        //     placeholder: "06-40/5060701",
        //     class: "form-control"
        // }
    };

    var userDetailsLabel = {
        name: "Név:",
        //bornDate: "Születési idő:",
        //sex: "Neme:",
        email: "E-mail:",
        //telephone: "Tel.:"
    };

    $(document).on("click", "#createUserModal", function () {

        var emptyObject = {
            bornDate: '',
            created_at: '',
            email: '',
            name: '',
            sex: '',
            telephone: ''
        };

        $("#usermodalContent").empty();
        $("#usermodalContent").append(
            createUserModalContent(emptyObject, true)
        );

        $("#userDetailsModal")
            .modal()
            .show();
    });

    $(document).on("click", ".saveCreateUserModal", function () {
        var userId = $(userDetailsTable).attr("data-user-id");

        var name = $("input[name='name']").val();
        var password = $("input[name='password']").val();
        var passwordConfirm = $("input[name='passwordConfirm']").val();
        var email = $("input[name='email']").val();
        var telephone = $("input[name='telephone']").val();
        var sex = $("#sex option:selected").val();
        var bornDate = $("input[name='bornDate']").val();

        var ajaxUrl = userId == 'undefined' ? "/admin/users/create" : "/admin/users/update";

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: ajaxUrl,
            type: "POST",
            data: {
                id: userId,
                name: name,
                password: password,
                passwordConfirm: passwordConfirm,
                email: email,
                telephone: telephone,
                sex: sex,
                bornDate: bornDate
            },
            success: function (data) {
                if (!$.isEmptyObject(data.errors)) {
                    manageErrorLabels(data.errors);
                }
                if (!$.isEmptyObject(data.success)) {
                    pageReload();
                }
            }
        });
    });

    function manageErrorLabels(errors) {
        $.each(formInputs, function (key) {
            if (!errors.hasOwnProperty(key)) {
                var error = $("#" + key + "Error");
                if (!error.hasClass("d-none")) {
                    error.addClass("d-none");
                }
            } else {
                var error = $("#" + key + "Error");
                error.removeClass("d-none");
                error.text(errors[key]);
            }
        });
    }

    $(".userDetails").click(function () {
        var user_id = $(this).data("user-id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/user/" + user_id,
            type: "GET",
            success: function (data) {
                if (!$.isEmptyObject(data.errors)) {
                    // console.log(data.errors); //TODO: bootstrap alert window
                }
                if (!$.isEmptyObject(data.user)) {
                    $("#usermodalContent").empty();
                    $("#usermodalContent").append(
                        createUserModalContent(data.user, false)

                    );

                    $("#userDetailsModal")
                        .modal()
                        .show();
                }
            }
        });
    });

    function pageReload() {
        location.reload();
    }

    function createUserModalContent(userDetails, createUser) {
        var content =
            "<div class='col-md-3 col-lg-3'>";

        if (createUser == false) {
            // content += "<i id='userDetailsEdit' class='userEditIcon border border-secondary rounded fa fa-pencil fa-lg'></i>";
            content += "<i id='userDetailsEdit' class='fas fa-edit'></i>";
            $("#userModalTitle").text(userDetails['name']);
        } else {
            $("#userModalTitle").text("Új felhasználó hozzáadása");
        }

        content += "</div>" +
            "<div class='col-md-9 col-lg-9'>" +
            "<table id='user-details-table' class='table table-user-information' id='dTable'>" + userModalTable(userDetails, createUser) +
            "</table>" +
            "</div>";

        if (createUser == true) {
            addFooterToModal();
        } else {
            $(".modal-footer").remove();
        }

        return content;
    }

    function userModalTable(userDetails, isEditing) {
        var tableBody = "<tbody id='userDetailsTable' data-user-id='" + userDetails["id"] + "'>";
        if (isEditing == true) {
            $.each(formInputs, function (key, value) {
                tableBody += "<tr><td><b>" + value["label"] + "</b></td><td>";
                if (key == "sex") {
                    tableBody +=
                        '<select id="' + value['id'] + '" name="' + key + '"' + ' class="' + value['class'] + '">' +
                        '<option value="">Válassz...</option>' +
                        '<option value="1" ' + sexIsSelected(userDetails['sex'], 1) + ' >Férfi</option>' +
                        '<option value="2" ' + sexIsSelected(userDetails['sex'], 2) + ' >Nő</option>' +
                        '</select>';
                } else {
                    tableBody +=
                        "<input name='" + key +
                        "' type='" + value["type"] +
                        "' value='" + getJsonData(userDetails, key) +
                        "' id='" + value["id"] +
                        "' placeholder='" + value["placeholder"] +
                        "' class='" + value["class"] +
                        "' ></input>";
                }
                tableBody += "</td></tr>";

                tableBody += '<tr><td colspan="2" class="alert alert-danger d-none " id="' + value['id'] + 'Error"></td></tr>';
            });
        } else {
            tableBody += detailsTableContent(userDetails);
        }
        tableBody += "</tbody>";
        return tableBody;
    }

    function sexIsSelected(sex, optionValue) {
        return (sex == optionValue) ? 'selected' : '';
    }

    function getJsonData(object, key) {
        let undefined = "undefined";
        return (object[key] == null || object[key] == undefined) ? '' : object[key];
    }

    function detailsTableContent(userDetails) {
        var tableBodyContent = "";
        $.each(userDetailsLabel, function (key, value) {
            tableBodyContent += "<tr><td><b>" + value + "</b></td><td>";

            if (key != "sex") {
                tableBodyContent +=
                    userDetails[key] == null ? "" : userDetails[key];
            } else {
                tableBodyContent += sexNameSolveById(userDetails[key]);
            }

            tableBodyContent += "</td></tr>";
        });
        return tableBodyContent;
    }

    $(document).on("click", "#userDetailsEdit", function () {
        var userId = $(userDetailsTable).attr("data-user-id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/user/" + userId,
            type: "GET",
            success: function (data) {
                $("#usermodalContent").empty();
                $("#usermodalContent").append(
                    createUserModalContent(data.user, true)
                );
            }
        });

    });

    function addFooterToModal() {
        if ($("#userDetailsModal").has(".modal-footer").length == 0) {
            $("#usermodalContent").after(
                "<div class='modal-footer'>" +
                "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Bezárás</button>" +
                "<button type='button' class='btn btn-primary saveCreateUserModal'>Mentés</button>" +
                "</div>"
            );
        }
    }

    function sexNameSolveById(sexId) {
        return sexId == 2 ? "Nő" : "Férfi";
    }
});