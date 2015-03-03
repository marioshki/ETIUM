<?php

	//check if image file exists
	if(isset($_FILES['image'])){

		$options = isset($_POST['options']) ? $_POST['options'] : null;
		$action = isset($_POST['action']) ? $_POST['action'] : null;

		list($width, $height) = getimagesize($_FILES["image"]["tmp_name"]);
		// check if the file is really an image
		if ($width == null && $height == null) {
			die('Image not supported');
			return;
		}

		// if the image has the allowed format
		$fileType = exif_imagetype($_FILES["image"]["tmp_name"]);
		$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);

		if (!in_array($fileType, $allowed)) {
			die('Image not supported');
			return;
		}

		$image = new Imagick($_FILES["image"]["tmp_name"]);

		//if no image modification, just die.
		if($action != null){
			switch($action){

				case 'resize':
					resize($image,$options);
					break;
			}
		}else{
			die('No action present');
			return;
		}
	}



	function resize($image,$options){
		$height = !empty($options['height']) ? $options['height'] : 300;
		$width = !empty($options['width']) ? $options['width'] : 300;
		$filter = !empty($options['filter']) ? $options['filter'] : Imagick::FILTER_LANCZOS;
		$blur = !empty($options['blur']) ? $options['blur'] : 1;
		$bestfit = !empty($options['bestfit']) ? $options['bestfit'] : NULL;
		$image_aux = $image->resizeImage($height,$width,$filter,$blur,$bestfit);

		if($image_aux){
			header("Content-Type: image/png");
			echo $image;
		}
	}



?>