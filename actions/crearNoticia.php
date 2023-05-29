<?php
	if ($_FILES['upload-image']['name'] == null) {
		$imagen = $_FILES['upload-image1']['name'];
		$ext = $_FILES['upload-image1']['tmp_name'];
	} else {
		$imagen = $_FILES['upload-image']['name'];
		$ext = $_FILES['upload-image']['tmp_name'];
	}

	$dir = "../imagesPreg/".$imagen;
	move_uploaded_file($ext, $dir);
	header("Location: ../preguntas.php");
?>