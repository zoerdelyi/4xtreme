<?php
$img = $_POST['image'];
if (file_exists($_POST['route'] . $img))
	unlink($_POST['route'] . $img);
