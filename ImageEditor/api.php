<?php
	include_once('ImageEditor.php');

	$image = new ImageEditor();

	$source = isset($_GET['source']) ? $_GET['source'] : '/images/example.png';

	$image->setSource($source);


	if(isset($_GET['height']) || isset($_GET['width'])){
		$h = isset($_GET['height']) ? $_GET['height'] : '0';
		$w = isset($_GET['width']) ? $_GET['width'] : '0';

		$image->resize($h,$w);
	}

	if(isset($_GET['mirror'])){
		$mirror_mode = $_GET['mirror'];
		$image->mirror($mirror_mode);
	}

	header("Content-Type: image/png");
	echo $image->getResult();
?>
