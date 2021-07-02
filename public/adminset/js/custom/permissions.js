$(document).ready(function () {
    //TODO: change to save button
    $('.custom-checkbox :checkbox').change(function () {
        var permissionId = $(this).data("permissionId");
        var levelId = $(this).data("levelId");
        if (this.checked) {
            updatePermissionLevel(permissionId, levelId, true);
        } else {
            updatePermissionLevel(permissionId, levelId, false);
        }
    });

    function updatePermissionLevel(permissionId, levelId, isSetting) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/permissions/update",
            type: "POST",
            data: {
                'permissionId': permissionId,
                'levelId': levelId,
                'isSetting': isSetting
            },
            success: function (data) {
                // console.log(data.success);
                if (data.success && data.success == "deleted") {
                    $.notify(
                        "<strong>Sikeres törlés!</strong> A jogosultásgot sikeresen törölte."
                    );
                } else if (data.success && data.success == "saved") {
                    $.notify(
                        "<strong>Sikeres mentés!</strong> A jogosultásgot sikeresen beállította."
                    );
                }
            }
        });
    }
});
        