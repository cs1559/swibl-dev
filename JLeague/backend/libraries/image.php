<?php
/**
 * @version 		$Id: image.php 186 2010-12-26 12:08:20Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Library
 * @copyright 		(C) 2006-2011 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class JLImage {

	private $filename = null;
	private $folder = null;
	private $height = null;
	private $width = null;
	
	function __construct($filename,$folder=null) {
		$this->filename = $filename;
		$this->folder = $folder;
		list($width, $height, $type, $attr) = getimagesize($this->folder . DS . $this->filename);
		$this->setHeight($height);
		$this->setWidth($width);
	}
	public function getResource() {
		return $this->openImage($this->folder . DS . $this->filename);		
	}
	private function setHeight($height) {
		$this->height = $height;
	}
	private function setWidth($width) {
		$this->width = $width;
	}
	
	function getFilename() {
		return $this->filename;
	}
	function getFolder() {
		return $this->folder;
	}
	function getHeight() {
		return $this->height;
	}
	function getWidth() {
		return $this->width;
	}
	function getImageRatio() {
		return $this->getWidth() / $this->getHeight();
	}
	
	/**
	 * This function is used to determine if the image needs to be resized based on
	 * parameters specified by the client.
	 *
	 * @param int $maxheight
	 * @param int $maxwidth
	 * @return boolean
	 */
	function needToResize($maxheight, $maxwidth) {
		if ($this->getHeight() > $maxheight) {
			return true;
		}
		if ($this->getWidth() > $maxwidth) {
			return true;
		}
		return false;
	}
	public function toString() {
		echo "<pre>";
		echo " FOLDER:   " . $this->getFolder() . "\n";
		echo " FILE:     " . $this->getFilename() . "\n";
		echo " HEIGHT:   " . $this->getHeight() . "\n";
		echo " WIDTH:    " . $this->getWidth() . "\n";
		echo "<pre/>";
	}
	
	
	private function openImage ($file)
	{
		# JPEG:
		$im = @imagecreatefromjpeg($file);
		if ($im !== false) { return $im; }
		
		# GIF:
		$im = @imagecreatefromgif($file);
		if ($im !== false) { return $im; }
		
		# PNG:
		$im = @imagecreatefrompng($file);
		if ($im !== false) { return $im; }
		
		# GD File:
		$im = @imagecreatefromgd($file);
		if ($im !== false) { return $im; }
		
		# GD2 File:
		$im = @imagecreatefromgd2($file);
		if ($im !== false) { return $im; }
		
		# WBMP:
		$im = @imagecreatefromwbmp($file);
		if ($im !== false) { return $im; }
		
		# XBM:
		$im = @imagecreatefromxbm($file);
		if ($im !== false) { return $im; }
		
		# XPM:
		$im = @imagecreatefromxpm($file);
		if ($im !== false) { return $im; }
		
		# Try and load from string:
		$im = @imagecreatefromstring(file_get_contents($file));
		if ($im !== false) { return $im; }
	}	
	
	
	
}

?>