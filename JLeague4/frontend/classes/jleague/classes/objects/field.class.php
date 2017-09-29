<?php
/**
 * @version		$Id: field.class.php 468 2013-01-19 11:29:37Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLField extends JLBaseObject  {
	
	private $id = null;
	private $name = null;
	private $keycode = null;
	private $type = null;
	private $value = null;
	private $editable = 1;
	
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
}
?>