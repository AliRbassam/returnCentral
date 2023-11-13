<?php

class SimpleImage {
   
   var $image;
   var $image_type;
 
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null) {
	   // do this or they'll all go to jpeg
	   $image_type=$this->image_type;
	
	  if( $image_type == IMAGETYPE_JPEG ) {
		 imagejpeg($this->image,$filename,$compression);
	  } elseif( $image_type == IMAGETYPE_GIF ) {
		 imagegif($this->image,$filename);  
	  } elseif( $image_type == IMAGETYPE_PNG ) {
		// need this for transparent png to work          
		imagealphablending($this->image, false);
		imagesavealpha($this->image,true);
		imagepng($this->image,$filename);
	  }   
	  if( $permissions != null) {
		 chmod($filename,$permissions);
	  }
   }

   function getWidth() {
      return imagesx($this->image);
   }
   function getHeight() {
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }
   
   
   function resize($width,$height) {
	 $new_image = imagecreatetruecolor($width, $height);
	  /* Check if this image is PNG or GIF, then set if Transparent*/  
	  if(($this->image_type == IMAGETYPE_GIF) || ($this->image_type==IMAGETYPE_PNG)){
		  imagealphablending($new_image, false);
		  imagesavealpha($new_image,true);
		  $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
		  imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
	  }
	  imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
	
	  $this->image = $new_image;   
	}
   
   function crop($width,$height) {   
	  $ratio=$width/$height;
	  $imgRatio=$this->getWidth()/$this->getHeight();
	  
	  if($imgRatio > $ratio) {
		  $this->resizeToHeight($height); //find smallest length
	  }else {
		  $this->resizeToWidth($width); 
	  }
	  
	  $new_image = imagecreatetruecolor($width, $height);
	  
	  $this->cropWidth   = $width; 
	  $this->cropHeight  = $height; 
   
	  $this->x = ($this->getWidth()-$this->cropWidth)/2;
	  $this->y = ($this->getHeight()-$this->cropHeight)/2;
	  
	  if(($this->image_type == IMAGETYPE_GIF) || ($this->image_type==IMAGETYPE_PNG)){
		  imagealphablending($new_image, false);
		  imagesavealpha($new_image,true);
		  $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
		  imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
	  }
	  imagecopyresampled($new_image, $this->image, 0, 0,  $this->x, $this->y, $width, $height, $this->cropWidth, $this->cropHeight);
	  
      $this->image = $new_image; 
   }
   
   
  function colorScale($r,$g,$b){
        imagefilter($this->image,IMG_FILTER_GRAYSCALE);
        $luminance=($r+$g+$b)/3; // average luminance added by the color
        $brightnessCorrection = $luminance/3; // quantity of brightness to correct for each channel
        //if( $luminance < 127 ){
            $brightnessCorrection -= 127/3; // color is dark so we have to negate the brightness correction
        //}
        if(! imageistruecolor($this->image) ){
            $nbColors = imagecolorstotal($this->image);
            for($i=0; $i<$nbColors; $i++){
                $c = array_values(imgagecolorsforindex($this->image,$i));
				$c[0] = max(0, min(255, $c[0] + ($r-$luminance) + $brightnessCorrection) ); // parentheses just for better comprehension
				$c[1] = max(0, min(255, $c[1] + ($g-$luminance) + $brightnessCorrection) ); // parentheses just for better comprehension
				$c[2] = max(0, min(255, $c[2] + ($b-$luminance) + $brightnessCorrection) ); // parentheses just for better comprehension
                imagecolorset($omgRes,$i,$c[0],$c[1],$c[2]);
            }
        }else{ // much easier with truecolor
            imagefilter($this->image, IMG_FILTER_COLORIZE, $r-$luminance, $g-$luminance, $b-$luminance);
            imagefilter($this->image, IMG_FILTER_BRIGHTNESS, $brightnessCorrection);
        }
  }
}
?>
