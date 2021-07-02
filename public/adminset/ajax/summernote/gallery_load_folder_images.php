<div class="modal-body-header">
    <?php
    if (isset($_POST['directory']) && isset($_POST['def_dir'])) {
        $directory = $_POST['directory'];


        // ha nem a "képi" gyökér mappában vagyunk, akkor aktiváljuk az egy szinttel feljebb (vissza) gombot)
        if ($_POST['def_dir'] != $directory) {
            // előző mappa kiszámítása:
            $back_dir = explode('/', trim($directory, '/'));
            array_pop($back_dir);
            $back_dir = implode('/', $back_dir) . '/';

            ?>
            <a id="back" class="folder_icon" data-dir="<?php echo $back_dir; ?>" title="<?php echo $back_dir; ?>"><i class="fa fa-level-up" aria-hidden="true"></i>
                <p><b>..</b></p>
            </a>
        <?php
    }
}
$dirs = array_filter(glob($directory . '*'), 'is_dir');

foreach ($dirs as $dir) {
    $last = explode('/', $dir);
    $last = end($last);
    echo '<a class="folder_icon" data-dir="' . $dir . '/" title="' . $dir . '/"><i class="fa fa-folder-o" aria-hidden="true"></i><p>' . $last . '</p></a>';
}
?>
</div>
<div class="modal-body" id="modal-gallery">
    <div class="row">
        <?php
        if (isset($_POST['directory'])) {
            $directory = $_POST['directory'];
            $site_url = $_POST['site_url'];
            $route = explode($_POST['din_route'], $directory);
            $route = $route[1];
            $route = ltrim($route, '/');
        } else {
            $route = '';
        }

        $images = glob($directory . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
        // usort($images, create_function('$b,$a', 'return filemtime($a) - filemtime($b);')); // fájlok dátum szerinti rendezése

        // fájlok dátum szerinti rendezése
        usort($images, function($b,$a){
            return filemtime($a) - filemtime($b);
        });

        $i = 0;
        foreach ($images as $image) {
            $image = basename($image);
            $img = $image;
            $image = $site_url . $route . $image
            ?>
            <div id="image_<?php echo $i ?>" class="col-lg-3 col-md-3 col-sm-4">
                <p class="image_name"><?php echo $img; ?></p>
                <div class="thumb" data-image-name="<?php echo $img; ?>" data-image="<?php echo $image; ?>"><span><img class="pop" style="" src="<?php echo $image; ?>" /></span></div>
                <div style="margin:-10px 0 14px 0" class="pull-right">
                    <a data-toggle="tooltip" class="delete-image" data-image_id="<?php echo $i ?>" data-image="<?php echo basename($image) ?>" href="javascript:;" title="Kép törlése"><i class="fa fa-trash-o fa-lg"></i></a>
                    <?php /* &nbsp;&nbsp;<a data-toggle="tooltip" class="insert-image" data-image="<?php echo $image ?>" title="Kép lecserélése" href="javascript:;"><i class="fa fa-sign-in fa-lg"></i></a> */ ?>
                </div>
            </div>
            <?php
            $i++;
            if ($i % 4 == 0) { // col-lg-3 col-md-3
                // echo '<div class="clearfix visible-sm-block"></div>';
                echo '<div class="clearfix visible-md-block visible-lg-block"></div>';
            } elseif ($i % 3 == 0) { // col-sm-4
                echo '<div class="clearfix visible-sm-block"></div>';
            }
        } ?>
    </div>
</div>