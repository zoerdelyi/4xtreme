$(document).ready(function () {

    $(document).on("click", ".userDelete", function () {
        if (
            confirm(
                "Biztosan el szeretné távolítani?"
            )
        ) {
            var user_id = $(this).data("user-id");
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/admin/users/remove/" + user_id,
                type: "PUT",
                success: function (data) {
                    if (data.errors) {
                        // console.log(data)
                        $.notify(
                            "<strong>Sikeres mentés!</strong> A jogosultásgot sikeresen beállította."
                        ),{
                            type: 'error'
                        };
                    }
                    if (data.success) {
                        $.notify({
                            message: "<strong>Sikeres törlés!</strong> Felhasználót sikeresen törölte."
                        },{
                            type: 'success'
                        });
                    }
                    pageReload();
                }
            });
        }
    });

    function pageReload() {
        location.reload();
    }
});