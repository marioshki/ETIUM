<?php
	class ImageEditor
	{
		private $image;

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

		public function openSource($source){
			if(strpos($source, 'http://')===0 || strpos($source,'ftp://') === 0){
				return $source;
			}elseif(file_exists($_SERVER['DOCUMENT_ROOT'] . $source)){
				return $_SERVER['DOCUMENT_ROOT'] . $source;
			}else{
				return $_SERVER['DOCUMENT_ROOT'] . '/images/error.jpg';
			}
		}

		public function resize($w,$h){
			$actual_width = $this->image->getImageWidth();
			$actual_height = $this->image->getImageHeight();

			if($w != null && $h!=null){
				$this->image->adaptiveResizeImage($w,$h,false);
			}else{
				$this->image->resizeImage($w,$h,1,true);
			}
		}

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

		public function opacity($opacity){
			if($this->image->getImageMimeType() == 'image/png')
				$this->image->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity, Imagick::CHANNEL_ALPHA);
		}

		// ROTATE IMAGE

		public function rotate($rotate){
			$this->image->rotateImage(new ImagickPixel('#FFF'), $rotate);
		}

		public function getResult(){
			return $this->image;
		}
	}
?>
