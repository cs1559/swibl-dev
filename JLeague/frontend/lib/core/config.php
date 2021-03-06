<?php
/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */
// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');

//include ('property.php');

class fsConfig {
	
	var $properties = null;
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new self();
		}
		return $instance;
	}
	
	
	function setProperty($inname, $invalue) {
		$this->addProperty($inname, $invalue);
	}
    function addProperty($inname, $invalue) {
    	$prop = new fsProperty($inname, ltrim($invalue));
    	$this->setPropertyObject($prop);
    }
 	private function setPropertyObject(fsProperty $prop) {
 		$this->properties[$prop->getName()] = $prop->getValue();
 	}    
    	
   	function setProperties($inParm) {
 		$this->props = $inParm;
 	}
 	function getProperties() {
 		return $this->props;
 	}
 	function getPropertyValue($key) {
 		if ($this->properties == null) 
 			return null;
 		if (isset($this->properties[$key])) {
 			return $this->properties[$key];
 		} else {
 			return null;
 		}
 	}
 	function getProperty($key) {
 		return $this->getPropertyValue($key);
 	}	
}

?>