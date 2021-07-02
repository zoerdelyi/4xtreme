$(document).ready(function() {
    $.ajax({
        url: "/adminset/ajax/summernote/gallery.php",
        dataType: "html",
        success: function(html) {
          $("#gallery_holder").html(html);
        }
      });
});