<?php

	include_once('ImageEditor.php');


	//DEFINED VARIABLES
	$image = new ImageEditor();
	$source = 'http://image-editor.local:8000/images/example.png';
	$width = null;
	$height = null;
	$mirror = null;



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

	if(isset($_GET['mirror'])){
		$mirror = $_GET['mirror'];
	}elseif(isset($GET['mrr'])){
		$mirror = $_GET['mrr'];
	}



	$image->setSource($source);

	$image->resize($height,$width);

	$image->mirror($mirror);

	header("Content-Type: image/png");
	echo $image->getResult();
?>
