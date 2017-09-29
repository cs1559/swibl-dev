<?php

/**
 * @version		$Id: property.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The Property class represents a name/value pair that is used to define specific 
 * properties for maps, markers or other objects where properties are appropriate. 
 * @package Maps
 */

class JLProperty {
	
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