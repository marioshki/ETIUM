<?php

	include_once('ImageEditor.php');


	//DEFINED VARIABLES

	if(class_exists('ImageEditor')){
		$image = new ImageEditor();
	}else{
		die('Error loading ImageEditor');
	}

	$source = 'http://image-editor.local:8000/images/example.png';
	$width = null;
	$height = null;
	$mirror = null;
	$opacity = null;
	$rotate = null;
	$crop = null;
	$chop = null;
	$blur = null;
	$format = null;

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
	}elseif(isset($_GET['mrr'])){
		$mirror = $_GET['mrr'];
	}

	if(isset($_GET['opacity'])){
		$opacity = $_GET['opacity'];
	}elseif(isset($_GET['opc'])){
		$opacity = $_GET['opc'];
	}

	if(isset($_GET['rotate'])){
		$rotate = $_GET['rotate'];
	}elseif(isset($_GET['rtt'])){
		$rotate = $_GET['rtt'];
	}

	if(isset($_GET['crop'])){
		$crop = $_GET['crop'];
	}elseif(isset($_GET['crp'])){
		$crop = $_GET['crp'];
	}

	if(isset($_GET['chop'])){
		$chop = $_GET['chop'];
	}elseif(isset($_GET['chp'])){
		$chop = $_GET['chp'];
	}

	if(isset($_GET['blur'])){
		$blur = $_GET['blur'];
	}elseif(isset($_GET['blr'])){
		$blur = $_GET['blr'];
	}

	if(isset($_GET['format'])){
		$format = $_GET['format'];
	}elseif(isset($_GET['fmt'])){
		$format = $_GET['fmt'];
	}


	//DO THE MAGIC

	if($source)
		$image->setSource($source);

	if($height || $width)
		$image->resize($height,$width);

	if($mirror)
		$image->mirror($mirror);

	if($opacity)
		$image->opacity($opacity);

	if($rotate)
		$image->rotate($rotate);

	if($crop)
		$image->crop($crop);

	if($chop)
		$image->chop($chop);

	if($blur)
		$image->blur($blur);

	if($format)
		$image->format($format);

	header("Content-Type: image/png");
	echo $image->getResult();
?>
