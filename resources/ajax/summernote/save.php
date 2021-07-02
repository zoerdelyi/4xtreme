<?php
include 'ImageResize.php';

use \Gumlet\ImageResize;

if ($_FILES['file']['name']) {
  if (!$_FILES['file']['error']) {

    $name = date('YmdHis');
    $ext = explode('.', $_FILES['file']['name']);
    $filename = $name . '.' . $ext[1];
    $destination = $_POST['route'] . $filename;
    $location = $_FILES["file"]["tmp_name"];

    $image = new ImageResize($location);
    $image->resizeToHeight(1000);
    $image->save($location);

    move_uploaded_file($location, $destination);
    $return_data = array('error' => 0);
    echo json_encode($return_data);
  } else {
    echo  $message = 'A képfeltöltés közben a következő hiba történt:  ' . $_FILES['file']['error'];
  }
}
