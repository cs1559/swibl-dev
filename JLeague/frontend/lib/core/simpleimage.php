<?php

/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class fsSimpleImage {
   
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
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }   
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
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
   function myResize($height, $width) {
   		if ($this->getHeight() > $this->getWidth()) {
   			$this->resizeToHeight($height);
   		} else {
   			$this->resizeToWidth($width);
   		}
   }
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
  
   function resize($destWidth,$destHeight) {

   		$originalHeight = $this->getHeight();
      	$originalWidth = $this->getWidth();
   	
		// Create base image.
   		$new_image = imagecreatetruecolor($destWidth, $destHeight);
   		$greybackground = ImageColorAllocate( $new_image , 255, 255, 255 );
   		imagefill($new_image,0,0,$greybackground);

   		$currentHeight = $this->getHeight();
      	$currentWidth = $this->getWidth();
      	
      	/*
   		if ($this->getHeight() > $this->getWidth()) {
		    $ratio = $destHeight / $this->getHeight();
            $currentWidth = $this->getWidth() * $ratio;
   		} else {
		    $ratio = $destWidth / $this->getWidth();
      		$currentHeight = $this->getheight() * $ratio; 			
   		}
*/
   		
		/*
      	imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $destWidth, $destHeight, $this->getWidth(), $this->getHeight());
      	$this->image = $new_image;    	
   		return; 
   		  */
		
      	$sourceX = 0;
      	$sourceY = 0;
      	
      	$targetX = 0;
		$targetY = 0;
      	
   		if( ($originalHeight < $destHeight) && ($originalWidth < $destWidth) )
		{
			$targetX = intval( ($destWidth - $currentWidth) / 2);
			$targetY = intval( ($destHeight - $currentHeight) / 2);
	
			// Since the 
	 		$destWidth = $currentWidth;
	 		$destHeight = $currentHeight;
		}
		      	
		/*
		print_r("original height = " . $originalHeight . "<br/>");
		print_r("original width = " . $originalWidth. "<br/>");
		print_r("current height = " . $currentHeight. "<br/>");
		print_r("current width = " . $currentWidth. "<br/>"); 
		
		print_r("Target X = " . $targetX. "<br/>");
		print_r("Target Y = " . $targetY. "<br/>");		
		*/
		
		//imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		//imagecopyresized($new_image, $this->image, $targetX, $targetY, $sourceX, $sourceY, $destWidth , $destHeight , $currentWidth , $currentHeight );
		imagecopyresampled($new_image, $this->image, $targetX, $targetY, $sourceX, $sourceY, $destWidth , $destHeight , $currentWidth , $currentHeight );
		            
      	//imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      	$this->image = $new_image;
   }
}
?>


