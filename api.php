<?php

		$options = isset($_GET['options']) ? $_GET['options'] : null;
		$action = isset($_GET['action']) ? $_GET['action'] : null;

		$image_url = isset($_GET['image_url'] ? $_GET['image_url']: '/images/example.png';

		$handle = fopen($image_url, 'rb');

		$image = new Imagick();

		$image->readImageFile($handle);


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