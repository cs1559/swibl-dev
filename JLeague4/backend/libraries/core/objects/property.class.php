<?php

/**
 * @version		$Id: property.class.php 53 2010-02-24 23:27:08Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	Commercial
 * 
 */


defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The Property class represents a name/value pair that is used to define specific 
 * properties for maps, markers or other objects where properties are appropriate. 
 * @package Maps
 */

class FSTProperty {
	
	private $name = null;
	private $value = null;
	
	
	/**
	 * Constructor initializing the name and value of the property
	 *
	 * @param string $inName
	 * @param object $inValue
	 */
 	function __construct($inName, $inValue) {
 		$this->name = $inName;
 		$this->value = $inValue;
 	}
 	
 	/**
 	 * Returns the property name
 	 *
 	 * @return string
 	 */
 	function getName() {
 		return $this->name;
 	}
 	
 	/**
 	 * Returns the value of the property
 	 *
 	 * @return object
 	 */
 	function getValue() {
 		return $this->value;
 	}
}
?>