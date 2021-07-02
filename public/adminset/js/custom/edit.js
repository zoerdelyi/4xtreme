// draggable beállítások
$(document).ready(function() {
    new Sortable(draggablePanelList, {
        handle: ".handle", // handle's class
        animation: 150
    });

    // Dark mód állítása
    $(".custom-control-input").change(function() {
        var dark_mode_id = $(this).attr("data-id");
        var dark_mode_on = 0;
        if ($(this).is(":checked")) {
            dark_mode_on = 1;
            $(this)
                .closest(".panel-info")
                .find(".note-editable")
                .css("background", "#000");
            $.notify(
                {
                    message:
                        "<strong>Sötét mód bekapcsolva itt: </strong>" +
                        $(this)
                            .closest(".right_block")
                            .find(".block_id")
                            .text()
                },
                {
                    type: "success"
                }
            );
        } else {
            $(this)
                .closest(".panel-info")
                .find(".note-editable")
                .css("background", "#FFF");
            $.notify(
                {
                    message:
                        "<strong>Sötét mód kikapcsolva itt: </strong>" +
                        $(this)
                            .closest(".right_block")
                            .find(".block_id")
                            .text()
                },
                {
                    type: "danger"
                }
            );
        }

        // ajax Update adatbázis felé
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/dark_mode",
            data: {
                id: dark_mode_id,
                dark_mode_on: dark_mode_on
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data); // json-t
                if (data.errors) {
                    // ha VAN hiba
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                } else {
                    if (data.success) {
                        // ha VAN változó / success
                        $.notify(
                            {
                                message:
                                    "<strong>Sikeres mentés!</strong> A blokk sötét mód beállítása frissítve az adatbázisban."
                            },
                            {
                                type: "success"
                            }
                        );
                    }
                }
            }
        });
    });

    // Dark mód oldal megnyitásakor

    // var panelList = $("#draggablePanelList");
    // panelList.sortable({
    //     // Only make the .panel-list-heading child elements support dragging.
    //     // Omit this to make then entire <li>...</li> draggable.
    //     handle: ".panel-list-heading",
    //     update: function() {
    //         $(".panel", panelList).each(function(index, elem) {
    //             var $listItem = $(elem),
    //                 newIndex = $listItem.index();

    //             // Persist the new indices.
    //         });
    //     }
    // });

    // utólag appendelt elemeknél csak így működik a click() function
    $(document).on("click", ".edit_block", function() {
        $(this)
            .closest(".panel-info")
            .children(".panel-list-body")
            .toggle();
        
        $('.note-popover').hide();
    });

    var current_order = [];
    $(".panel-info").each(function() {
        current_order.push($(this).attr("data-id"));
    });

    function recreate_order() {
        current_order = [];
        $(".panel-info").each(function() {
            current_order.push($(this).attr("data-id"));
        });
        if (current_order.length > 0) {
            return current_order.join();
        } else {
            return "noblocks";
        }
    }

    var blocks_ids = "";
    $(document).on("click", "#order_save", function() {
        blocks_ids = recreate_order();
        // ha az elrendezés mentése gombra kattint, akkor ajax-al updatel
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/pages",
            data: {
                blocks_ids: blocks_ids,
                page_id: $("#page_id").val()
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data); // json-t
                if (data.errors) {
                    // ha VAN hiba
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                } else {
                    if (data.success) {
                        // ha VAN változó / success
                        $.notify(
                            {
                                message:
                                    "<strong>Sikeres mentés!</strong> Az oldal blokkrendszerének elrendezése frissítésre került az adatbázisban."
                            },
                            {
                                type: "success"
                            }
                        );
                    }
                }
            }
        });
    });

    $(document).on("click", ".update_block", function() {
        // zseniális trükk: el tudom érni vele az ajaxból ezt a this selectort:
        var that = this;
        // ha a Mentés, vagy a Változások mentése gombra kattint akkor ajax-al updateli a blokk tartalmát
        var block_id = $(that).attr("data-id");
        var block_content = $(that)
            .closest(".panel-info")
            .find(".block_content")
            .val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/blocks",
            data: {
                block_id: block_id,
                block_content: block_content
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                if (data.errors) {
                    // ha VAN hiba
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                } else {
                    if (data.success) {
                        // ha VAN változó / success
                        $.notify(
                            {
                                message:
                                    "<strong>Sikeres mentés!</strong> Blokk id: " +
                                    data.success +
                                    " frissítve az adatbázisban."
                            },
                            {
                                type: "success"
                            }
                        );
                        $("#order_save").click();
                    }
                }
            }
        });
    });
});

// # # # # # # # # # # # # # # # # # # # # # Summernote Image Manager # # # # # # # # # # # # # # # # # # # # #
// globális változók létrehozása
var that_img = "";
var that_img_html = "";
var current_route = "";
$(document).ready(function() {
    function create_summernotes() {
        $(".summernote").summernote({
            lang: "hu-HU", // default: 'en-US'
            codemirror: {
                // codemirror options
                theme: "monokai",
                lineWrapping: true
            },
            callbacks: {
                // callback for pasting text only (no formatting)
                onPaste: function(e) {
                    var bufferText = (
                        (e.originalEvent || e).clipboardData ||
                        window.clipboardData
                    ).getData("Text");
                    e.preventDefault();
                    bufferText = bufferText.replace(/\r?\n/g, "<br>");
                    document.execCommand("insertHtml", false, bufferText);
                }
            },
            toolbar: [
                ["style", ["style"]],
                [
                    "font",
                    [
                        "bold",
                        "italic",
                        "underline",
                        "strikethrough",
                        "superscript",
                        "subscript",
                        "clear"
                    ]
                ],
                ["fontsize", ["fontsize"]],
                ["color", ["color"]],
                ["para", ["ol", "ul", "paragraph", "height"]],
                ["table", ["table"]],
                ["insert", ["link", "image"]],
                ["view", ["undo", "redo", "fullscreen", "codeview", "help"]]
            ],
            disableResizeImage: true,
            disableDragAndDrop: true,
            popover: {
                image: [["remove", ["removeMedia"]]],
                link: [["link", ["linkDialogShow", "unlink"]]],
                air: [
                    ["color", ["color"]],
                    ["font", ["bold", "underline", "clear"]],
                    ["para", ["ul", "paragraph"]],
                    ["table", ["table"]],
                    ["insert", ["link", "picture"]]
                ]
            }
        });

        // összes summernote csekkolása, hogy van-e dark_mode
        $(".custom-control-input").each(function(e) {
            if (this.checked) {
                $(this)
                    .closest(".panel-info")
                    .find(".note-editable")
                    .css("background", "#000");
            }
        });
    }
    create_summernotes();
    // # # # # # # # # # # # # # # # # # # # # # Summernote Image Manager # # # # # # # # # # # # # # # # # # # # #

    window.reopenFolders;
    $(document).on("click", "#new_block_add", function() {
        $("#new_block_add").hide();
        $("#new_block_hidden").show();
    });

    $("#new_block_hidden_create").click(function() {
        var new_block_id = $("#new_block_hidden_select")
            .children(":selected")
            .val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/blocks/append",
            data: {
                block_id: new_block_id
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                if (data.errors) {
                    // ha VAN hiba
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                } else {
                    if (data.success) {
                        // ha VAN változó / success

                        var block_content = data.content;
                        var block_name = data.name;

                        // átadjuk az append-nek az új adatokat
                        $("#draggablePanelList").append(
                            addBlocksToPages(
                                new_block_id,
                                block_name,
                                block_content
                            )
                        );
                        // rekreáljuk a summentote-kat
                        create_summernotes();
                    }
                }
            }
        });
    });

    function addBlocksToPages(block_id, block_name, block_content) {
        return (
            '<li class="panel panel-info" data-id="' +
            block_id +
            '">' +
            '<div class="panel-list-heading">' +
            '<i class="fas fa-arrows-alt handle"></i>' +
            '<p class="block_name">' +
            block_name +
            "</p>" +
            '<div class="right_block">' +
            '<span class="block_id">blokk id: ' +
            block_id +
            "</span>" +
            '<button type="button" class="btn btn-success update_block" data-id="' +
            block_id +
            '">' +
            '<i class="fas fa-save"></i><span>Mentés</span>' +
            "</button>" +
            '<div class="edit_block">' +
            '<i class="fas fa-edit"></i><span>Szerkesztés</span>' +
            "</div>" +
            '<div class="remove_block">' +
            '<i class="fas fa-trash-alt"></i><span>Eltávolítás</span>' +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="panel-list-body">' +
            "<!-- Bootstrap Isolate - kompatibilitási fix -->" +
            '<div class="bootstrap-iso">' +
            '<textarea class="block_content summernote">' +
            block_content +
            "</textarea>" +
            "</div>" +
            '<button type="button" class="btn btn-success update_block" data-id="' +
            block_id +
            '">' +
            '<i class="fas fa-save"></i><span>Módosítások mentése</span>' +
            "</button>" +
            "</div>" +
            "</li>"
        );
    }

    $(document).on("click", ".remove_block", function() {
        if (
            confirm(
                "Biztosan el szeretné távolítani ezt a blokkot az oldalról?"
            )
        ) {
            $(this)
                .closest(".panel-info")
                .remove();
        }
    });
});
