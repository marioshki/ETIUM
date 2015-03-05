<?php

	include_once('ImageEditor.php');

	$image = new ImageEditor();


	$source = isset($_GET['source']) ? $_GET['source'] : '/images/example.png';

	$image->setSource($source);


		if(isset($_GET['h']) || isset($_GET['w'])){

			$h = isset($_GET['h']) ? $_GET['h'] : null;
			$w = isset($_GET['w']) ? $_GET['w'] : null;

			$image->resize($h,$w);

		}

		header("Content-Type: image/png");
		echo $image->getResult();

?>
