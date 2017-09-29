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

//include_once('exception.php');

/**
 * The fsView is the foundation view that all views extend from.
 *
 */
class fsController {
	
	var $_tasks = array();
	
	function __construct() {
		
		$rc = new ReflectionClass($this);
		$methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC);
		foreach ($methods as $method) {
			$this->_tasks[] = $method->getName();
		}
		
	}
	
	function display() {
		echo "";
	}
	
	function execute($task = null) {
		if (in_array($task, $this->_tasks)) {
			$this->$task();
		} else {
			throw new fsException("Unknown task");
		}
	}
	
	function showTasks() {
		print_r($this->_tasks);
	}
	
	function getReqValue($key, $default_value="") {
		$req = &fsRequest::getInstance();
		$val = $req->getValue($key);
		if ($val == null) {
			return $default_value;
		} else {
			return $val;
		}
	}

}
?>