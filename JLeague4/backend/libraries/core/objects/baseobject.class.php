<?php

/**
 * @version $Id: baseobject.class.php 56 2010-02-27 01:40:17Z Chris Strieter $ 
 * @author Chris Strieter 
 * @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved 
 * @package 		FSTCore
 * @subpackage 		Objects
 * @license See license.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The Base Object is a core object in which other objects will extend from.  The PROPERTIES
 * functions are for objects whose underlying table maintains various attributes all within ONE 
 * table column.
 */

require_once('property.class.php');

class FSTBaseObject {
	
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
    	$prop = new FSTProperty($inname, ltrim($invalue));
    	$this->setPropertyObject($prop);
    }
    
    function getPublished() {
    	return $this->published;
    }
    function setPublished($published) {
    	$this->published = $published;
    }

    /**
     * This is a private helper function that adds a property object to the array of properties.
     *
     * @param JLProperty $prop
     */
 	private function setPropertyObject(JLProperty $prop) {
 		$this->properties[$prop->getName()] = $prop->getValue();
 		//$this->properties[] = $prop;
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
 			$prop = new FSTProperty($key,$this->properties[$key]);
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
// 		$proparray = split("\n",$props);
		$proparray = preg_split("/[\n]+/",$props);
		for ($y=0; $y<(sizeof($proparray)); $y++) {
// 			$prop = split("=",$proparray[$y]);
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
 	 	
	function getCustomFields() {
		return $this->fields;
	}
	function setCustomFields(array $fields) {
		$this->fields = $fields;
	}
	function getFieldName($key) {
		if (isset($this->fields[$key])) {
			$fld = $this->fields[$key];
			if (is_object($fld)) {
				return $fld->getName();
			}
			return null;
		}
		return null;
	}
	
	function getFieldValue($key) {
		if (isset($this->fields[$key])) {
			$fld = $this->fields[$key];
			if (is_object($fld)) {
				return $fld->getValue();
			}
			return null;
		}
		return null;
	}
	function setField(FSTField $fld) {
		$this->fields[$fld->getKeycode()] = $fld;
	} 	

	function getFields() {
		return $this->fields;
	}
}
?>