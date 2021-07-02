<div class="modal-dialog modal-lg" style="overflow:initial">
    <div class="modal-content">
        <div class="btn-default modal-header" style="padding-bottom: 10px;">
            <h5 class="modal-title"><i class="fa fa-image"></i>&nbsp;&nbsp;Képgaléria</h5>
            <div class="ml-auto">
                <button type="button" data-toggle="tooltip" title="" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;KÉP FELTÖLTÉSE</button>
                <!--<button type="button" class="btn btn-outline-dark" data-dismiss="modal" aria-hidden="true">Bezárás</button>-->
            </div>
        </div>
        <?php
        $site_url = '/images/slider-gallery-pictrures/'; //edit path
        $directory = "../../../images/slider-gallery-pictrures/"; //edit path

        // dinamikus route kinyerése - majd ezt küldjük el ajax-al. ez után a hosszú route-t a din_route-al explode-oljuk szét, így az eredmény az arr[1] lesz (a route második fele)
        $din_route = rtrim($directory, '/');
        $din_route = explode('/', $din_route);
        $din_route = end($din_route);

        ?>
        <script>
            // alap route generálása
            current_route = '<?php echo $directory; ?>';
            $('body').on("click", ".folder_icon", function() {
                var current_dir = $(this).attr('data-dir');
                current_route = current_dir; // aktuális útvonal hozzáadása a globális route változóhoz
                load_folders_images(current_dir); // elérési útvonal, mappák és galéria frissítése az aktuális route alapján
            });

            function load_folders_images(current_dir) {
                $.ajax({
                    url: "/adminset/ajax/summernote/gallery_load_folder_images.php",
                    type: "POST",
                    data: {
                        directory: current_dir,
                        def_dir: '<?php echo $directory; ?>',
                        site_url: '<?php echo $site_url; ?>',
                        din_route: '<?php echo $din_route; ?>'
                    },
                    success: function(html) {
                        $('.modal-body-route p').html(current_dir);
                        $('#modal-folders-images').html(html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        </script>
        <div class="modal-body-route">
            <p><?php echo $directory; ?></p>
        </div>
        <div id="modal-folders-images">
            <?php
            require('gallery_load_folder_images.php');
            ?>
        </div>
    </div>
</div>

<!-- show image popup -->
<div class="modal fade spec_modal_holder" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md spec_modal">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="imagepreview" style="width:100%;">
                <p id="imagepreview_name" style="float: left;"></p>
                <button type="button" class="btn btn-default close-modal" style="float: right;">Bezárás</button>
            </div>
        </div>
    </div>
</div>

<!-- delete image popup -->
<div class="modal fade spec_modal_holder" id="imagemodaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md spec_modal">
        <div class="modal-content">
            <div class="btn-warning modal-header">
                <h4 class="modal-title"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Kép törlése</h4>
            </div>
            <div class="modal-body">
                Valóban törölni akarja ezt a képet?
            </div>
            <p style="text-align:right;padding-right:20px">
                <button type="button" id="delete_image" class="btn btn-primary close-modal">Igen</button>&nbsp;<button type="button" class="btn btn-default close-modal">Nem</button>
            </p>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    })

    /*
    $(document).on("click", ".insert-image", function() {
        var image = $(this).data('image');
        var to_change = $(that_img_html);
        to_change.attr('src', image);
        that_img.context.triggerEvent('media.delete', to_change, that_img.$editable);
        // $('.summernote').summernote('editor.insertText', '');
        correct_link_imgs(); // speciális javítások ebbe a függvénybe mehetnek!
        $('.summernote').each(function(){
            $(this).summernote('editor.insertText', ''); // így felülíródik a képcsere, elmentődik a módosítás
        });


        $('#modal-image').modal('hide');
    });*/

    $(document).on("click", ".thumb", function() {
        $('#imagepreview').attr('src', $(this).data('image'));
        $('#imagepreview_name').text($(this).data('image-name'));
        $('#imagemodal').modal('show');
    });

    $(document).on("click", ".close-modal", function() {
        $('#imagepreview').attr('src', '');
        $('#imagepreview_name').text('');
        $('#imagemodal').modal('hide');
        $('#imagemodaldelete').modal('hide');
    });

    var image_to_delete;
    var image_id;

    $(document).on("click", ".delete-image", function() {
        $('#imagemodaldelete').modal('show');
        image_to_delete = $(this).data('image');
        image_id = $(this).data('image_id');
    })

    $(document).on("click", "#delete_image", function() {
        $.ajax({
            type: "POST",
            data: ({
                'image': image_to_delete,
                'route': current_route
            }),
            url: "/adminset/ajax/summernote/delete.php",
            success: function(data) {
                $("#image_" + image_id).fadeOut()
                $('#imagemodaldelete').modal('hide');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })

    });

    $(document).on("click", "#button-upload", function() {
        $('#form-upload').remove();

        $('body').prepend(
            '<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>'
        );

        $('#form-upload input[name="file"]').trigger('click');

        $(document).on("change", '#form-upload input[name="file"]', function() {
            if ($(this).val() != '') {

                var form_data = new FormData($('#form-upload')[0]);
                form_data.append('route', current_route);

                $.ajax({
                    url: '/adminset/ajax/summernote/save.php',
                    type: 'post',
                    data: form_data,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#button-upload').html(
                            '<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;&nbsp;FELTÖLÉS'
                        );
                        $('#button-upload').prop('disabled', true);
                    },
                    complete: function() {
                        $('#button-upload').html(
                            '<i class="fa fa-upload"></i>&nbsp;&nbsp;KÉP FELTÖLTÉSE');
                        $('#button-upload').prop('disabled', false);
                    },
                    success: function(json) {
                        load_folders_images(current_route);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });
    });
</script>