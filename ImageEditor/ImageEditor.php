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
				$this->image->resizeImage($w,$h,null,1);
			}else{
				if($w!=null){
					//CALCULAR RATIO AL CAMBIAR LA ALTURA
				}else{
					//CALCULAR RATIO AL CAMBIAR EL ANCHO
				}
			}


			}



		public function getResult(){
			return $this->image;
		}

	}
?>