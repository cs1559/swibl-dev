<?php

/**
 * @version		$Id: baseviewhelper.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');


/**
 * The JLBaseViewHelper is a helper class that is pushed into the template objects via the view.  Invidiviual view helpers should extend
 * this base class.  The intent is for these "view helper" objects to contain certain presentation logic that we prefer not to have
 * within the template.  The goal is to avoid any type of control logic (if..then..else, foreach(...), while ..), etc. within the template.
 * Each template should contain only HTML, Javascript and the minimum PHP code (i.e. <?php ... ?>.
 *
 */

class JLBaseViewHelper extends fsBaseObject {
	
	/**
	 * This procedure will return an HTML INPUT element.
	 *
	 * @param String $name
	 * @param String a$value
	 * @param int $size
	 * @param int $length
	 * @param String $class
	 * @return String
	 */
	function getInputElement($name,$value,$size=30,$length=30,$class=null) {
		if (!strlen($size) > 0) {
			$size = 30;
		}
		if (!strlen($length) > 0) {
			$length = 30;
		}
		if ($class != null) {
			return "<input type='text' name='".$name."' value='".$value."' size='".$size."' maxlength='".$length."' class='" . $class . "'/>";
		} else {
			return "<input type='text' name='".$name."' value='".$value."' size='".$size."' maxlength='".$length."'/>";
		}
	}
	
	/**
	 * Returns a hidden input element.
	 *
	 * @param string $name
	 * @param string $value
	 * @param string $class
	 * @return string
	 */
	function getHiddenInputELement($name, $value, $class = null) {
		if ($class != null) {
			return "<input type='hidden' name='" . $name."' value='".$value."' class='" . $class . "'/>";
		} else {
			return "<input type='hidden' name='" . $name ."' value='".$value."' />";
		}
	}
	
	/**
	 * Returns an HTML checkbox
	 *
	 * @param string $name
	 * @param string $state
	 * @param string $event
	 * @param string $class
	 * @return string
	 */
	function getCheckboxElement($name,$state,$event,$class=null) {
		if ($class != null) {
			return "<input type='checkbox' name='" . $name . "' " . $state . " " . $event . " class='" . $class . "'/>";
		} else {
			return "<input type='checkbox' name='" . $name . "' " . $state . " " . $event . "/>";
		}
	}
	
	/**
	 * Returns an HTML Textarea element.
	 *
	 * @param string $name
	 * @param string $value
	 * @param int $rows
	 * @param int $cols
	 * @return string
	 */
	function getTextAreaElement($name,$value,$rows=30,$cols=30) {
		if (!strlen($rows) > 0) {
			$rows = 30;
		}
		if (!strlen($cols) > 0) {
			$cols = 30;
		}
		
		return "<textarea name='".$name."' rows='".$rows."' cols='".$cols."'>" . $value . "</textarea>";
	}	
}
?>