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

class fsApplication {

	var $appname = null;
	var $appversion = null;
	var $properties = array();

	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new self();
		}
		return $instance;
	}

	function setName($name) {
		$this->appname = $name;
	}
	function getName() {
		return $this->appname;
	}
	
	function setVersion($ver) {
		$this->appversion = $ver;
	}
	function getVersion() {
		return $this->appversion;
	}
	
	function setProperty($key, $value) {
		$this->properties[$key] = $value;
	}
	function getProperty($key) {
		return $this->properties[$key];	
	}
	
	
	/*
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
	*/

}

?>