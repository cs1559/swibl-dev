<?php

/**
 * @version		$Id: baseobject.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The JLBaseObject is a common object that all primary objects should extend.  It provides
 * base functionality that should apply to all non-view objects.
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'property.class.php');

class JLBaseObject {
	
	var $properties = null;
	var $updatedby = null;
  	var $dateupdated = null;

	/**
	 * This is the constructor function.  When the object is instantiate, the properties array
	 * will be initiated.
	 *
	 */
	function __construct() {
 		$this->properties = array();
 	}

 	/**
 	 * This is a helper function that allows the calling client to just pass the name and value
 	 * to add the property without having to instantiate a new instance of the JLProperty object
 	 * first.
 	 *
 	 * @param String $inname
 	 * @param String $invalue
 	 */
    function addProperty($inname, $invalue) {
    	$newval = str_ireplace("=","&#61;",$invalue);
    	$prop = new JLProperty($inname, ltrim($newval));
    	$this->setPropertyObject($prop);
    }

    /**
     * This is a private helper function that adds a property object to the array of properties.
     *
     * @param JLProperty $prop
     */
 	private function setPropertyObject(JLProperty $prop) {
 		$this->properties[$prop->getName()] = $prop->getValue();
 	}
 	
 	/**
 	 * This function will return a property object - not just the value.  If the key is not 
 	 * found, then null will be return.
 	 *
 	 * @param String $key
 	 * @return JLProperty
 	 */
 	function getProperty($key) {
 		if (isset($this->properties[$key])) {
 			$prop = new JLProperty($key,$this->properties[$key]);
 			return $prop;
 		} else {
 			return null;
 		}
 	}
 	
 	function getProperties() {
 		return $this->properties;
 	}
 	/**
 	 * This fucntion will return ONLY the value of a given property.
 	 *
 	 * @param String $key
 	 * @return String
 	 */
 	function getPropertyValue($key) {
 		if (isset($this->properties[$key])) {
 			$prop = $this->properties[$key];
 			if (strlen($prop) > 0) {
				return $prop;
 			} else {
 				return null;
 			}
 		}
 		return null;
 	}
 	
 	/**
 	 * This function will format all of the name/value properties so that they can be persisted
 	 * within a TEXT column within the database.
 	 *
 	 * @return varchar
 	 */
 	function getFormattedProperties() {
 		$props = '';
 		foreach ($this->properties as $key => $val) {
 			//$props .= $pro->getName() . "=" . $pro->getValue . "\n";	
 			$newval = str_ireplace("=","&#61;",$val);    // Clean the value to replace any EQUAL signs with the HTML code	
 			$props .= $key . "=" . $val . "\n";
 		}
 		return $props;
 	}
 	
 	/**
 	 * This function will parse the properties stored within the database and populates
 	 * the data name/value pairs into an array.
 	 *
 	 * @param varchar $props
 	 */
 	function parseDatabaseObjectProperties($props) {
		//$proparray = split("\n",$props);
 		$proparray = preg_split("/[\n]+/",$props);
		for ($y=0; $y<(sizeof($proparray)); $y++) {
			//$prop = split("=",$proparray[$y]);
			$prop = preg_split("/[=]+/",$proparray[$y]);
			//TODO:  Revisit this.  This is a quick work around.  need to investigate origin of
			// why this $prop[1] would generate an undefined offset on the $prop array
			if (key_exists(1,$prop)) {
				$bad_characters = array("\n", "\r");
				$newprop = str_ireplace($bad_characters, "", $prop[1]); // remove bad characters 					
				$this->addProperty($prop[0],$newprop);
			}
		}
 	}
 	
 	/**
 	 * The getSlug function is used for SEO functionality.  It uses the name of the object and
 	 * its corresponding ID key.   (e.g.  253-Team-Name).
 	 *
 	 * @param int $id
 	 * @param String $name
 	 * @return String
 	 */
 	function getSlug($id,$name) {
		$config = & JLConfig::getInstance();
 		if ($config->getProperty('seo_enabled')) {			
			return $id . ":" . str_replace(" ","-",$name);
 		} else {
 			return $id;
 		}
 	}
 	
 	function setUpdatedBy($parm) {
 		$this->updatedby = $parm;
 	}
 	function getUpdatedBy() {
 		return $this->updatedby;
 	}
 	function setDateUpdated($parm) {
 		$this->dateupdated = $parm;
 	}
 	function getDateUpdated() {
 		return $this->dateupdated;
 	} 	
 	
}
?>