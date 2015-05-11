<?php

	include_once('ImageEditor.php');


	//DEFINED VARIABLES
	$image = new ImageEditor();
	$source = 'http://image-editor.local:8000/images/example.png';
	$width = null;
	$height = null;




	//LOOK UP FOR ALIASES OR SHORT CONFIGURATIONS
	if(isset($_GET['source'])){
		$source = $_GET['source'];
	}elseif(isset($_GET['src'])){
		$source = $_GET['src'];
	}

	if(isset($_GET['width'])){
		$width = $_GET['width'];
	}elseif(isset($_GET['w'])){
		$width = $_GET['w'];
	}

	if(isset($_GET['height'])){
		$height = $_GET['height'];
	}elseif(isset($_GET['h'])){
		$height = $_GET['h'];
	}




	$image->setSource($source);

	$image->resize($height,$width);

	if(isset($_GET['height']) || isset($_GET['width'])){
		$h = isset($_GET['height']) ? $_GET['height'] : null;
		$w = isset($_GET['width']) ? $_GET['width'] : null;

		$image->resize($h,$w);
	}

	if(isset($_GET['mirror'])){
		$mirror_mode = $_GET['mirror'];
		$image->mirror($mirror_mode);
	}

	header("Content-Type: image/png");
	echo $image->getResult();
?>
