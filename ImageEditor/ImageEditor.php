<?php
	class ImageEditor
	{
		private $image;

		//SET THE SOURCE (LOCAL OR REMOTE)

		public function setSource($source){

			$src = $this->openSource($source);
			$handle = fopen($src, 'rb');
			if(class_exists('Imagick')){
				$this->image = new Imagick();
			}else{
				die('Error loading Imagick');
			}
			$this->image->readImageFile($handle);
		}

		// HANDLE THE SOURCE
		public function openSource($source){
			if(strpos($source, 'http://')===0 || strpos($source,'ftp://') === 0){
				return $source;
			}elseif(file_exists($_SERVER['DOCUMENT_ROOT'] . $source)){
				return $_SERVER['DOCUMENT_ROOT'] . $source;
			}else{
				return $_SERVER['DOCUMENT_ROOT'] . '/images/error.jpg';
			}
		}

		// RESIZE THE IMAGE

		public function resize($w,$h){
			$actual_width = $this->image->getImageWidth();
			$actual_height = $this->image->getImageHeight();

			if($w != null && $h!=null){
				$this->image->adaptiveResizeImage($w,$h,false);
			}else{
				$this->image->resizeImage($w,$h,1,true);
			}
		}

		//MIRROR THE IMAGE

		public function mirror($mirror_mode){
			switch($mirror_mode){
				case 'vertical':
					$this->image->flopImage();
					break;
				case 'v':
					$this->image->flopImage();
					break;
				case 'horizontal':
					$this->image->flipImage();
					break;
				case 'h':
					$this->image->flipImage();
					break;
			}
		}


		// CHANGE THE IMAGE OPACITY (ONLY PNG)
		public function opacity($opacity){
			if($this->image->getImageMimeType() == 'image/png')
				$this->image->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity, Imagick::CHANNEL_ALPHA);
		}

		// ROTATE IMAGE

		public function rotate($rotate){
			$rotate = json_decode($rotate);
			if(empty($rotate[1])){
				return $this->image->rotateImage(new ImagickPixel("rgba(250,255,255,0)"), $rotate[0]);
			}else{
				return $this->image->rotateImage(new ImagickPixel($rotate[1]), $rotate[0]);
			}
		}

		// CROP IMAGE

		public function crop($crop){
			$crop = json_decode($crop);
			if( !empty( $crop[0] ) && !empty( $crop[1] ) && !empty( $crop[2] ) && !empty( $crop[3] ) ){
				$this->image->cropImage($crop[0],$crop[1],$crop[2],$crop[3]);
			}else{
				return false;
			}
		}

		// CHOP IMAGE

		public function chop($chop){
			$chop = json_decode($chop);
			if(!empty($chop[0]) && !empty($chop[1]) && !empty($chop[2]) && !empty($chop[3])){
				return $this->image->chopImage($chop[0],$chop[1],$chop[2],$chop[3]);
			}else{
				return false;
			}
		}

		// BLUR IMAGE

		public function blur($blur){
			$blur = json_decode($blur);
			if( !empty($blur[0]) && !empty($blur[1]) ){
				if(empty($blur[2])){
					return $this->image->blurImage($blur[0],$blur[1]);
				}else{
					return $this->image->blurImage($blur[0],$blur[1],$blur[2]);
				}
			}else{
				return false;
			}
		}

		// CHANGE IMAGE FORMAT

		public function format($format){
			return $this->image->setFormat($format);
		}

		public function getResult(){
			return $this->image;
		}
	}
?>
