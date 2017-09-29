<?php
/**
 * @version		$Id: field.class.php 53 2010-02-24 23:27:08Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	Commercial
 * 
 */

require_once('baseobject.class.php');

class FSTField extends FSTBaseObject  {
	
	private $id = null;
	private $name = null;
	private $keycode = null;
	private $type = null;
	private $value = null;
	private $label = null;
	
	function getId() {
		return $this->id;
	}
	function setId($inParm) {
		$this->id = $inParm;
	}

	function getName() {
		return $this->name;
	}
	function setName($inParm) {
		$this->name = $inParm;
	}
	function getLabel() {
		if ($this->label == null || strlen(trim($this->label)) == 0 ) {
			return self::getName();
		}
		return $this->label;
	}
	function setLabel($label) {
		$this->label = $label;
	}
	function getKeycode() {
		return $this->keycode;
	}
	function setKeycode($keycode) {
		$this->keycode = $keycode;
	}

	function getType() {
		return $this->type;
	}
	function setType($type) {
		$this->type = $type;
	}
	function getValue() {
		return $this->value;
	}
	function setValue($value) {
		$this->value=$value;
	}
}
?>