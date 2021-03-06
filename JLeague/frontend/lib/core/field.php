<?php
/**
 * @version		$Id: field.class.php 468 2013-01-19 11:29:37Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	Commercial
 * 
 */

class fsField extends fsBaseObject  {
	
	private $id = null;
	private $name = null;
	private $keycode = null;
	private $type = null;
	private $value = null;
	private $editable = 1;
	private $visible = 1;
	
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
	function setEditable($bool) {
		$this->editable = $bool;
	}
	function isEditable() {
		return $this->editable;
	}
	function setVisible($bool) {
		$this->visible = $bool;
	}
	function isVisible() {
		return $this->visible;
	}
}
?>