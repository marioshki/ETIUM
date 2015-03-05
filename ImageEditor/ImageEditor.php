<?php
	class ImageEditor
	{
		public $image;

		public function setSource($source){
			$handle = fopen($source, 'rb');
			$this->image = new Imagick();
			$this->image->readImageFile($handle);
		}

		public function resize($w,$h){
			$actual_width = $this->image->getImageWidth();
			$actual_height = $this->image->getImageHeight();

			if($w != null && $h!=null){
				$this->image->adaptiveResizeImage($w,$h,false);
			}else{
				$h = $h == null ?  '0' : $h;
				$w = $w == null ?  '0' : $w;
				$this->image->resizeImage($w,$h,1,true);
			}

		}

		public function getResult(){
			return $this->image;
		}
	}
?>