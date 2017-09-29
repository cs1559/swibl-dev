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
class fsDispatcher {

	var $_keyword = "controller";
	
	function __construct($key = "controller") {
		$this->_keyword = $key;
	}
	function dispatch(fsRequest &$request, fsResponse &$response, $route=null) {
		
		// Check to see if a controller name is passed - if not, set the default controller class name
		if ($controller = $request->getValue("controller")) {
			$classname = "m" . $controller;
		} else {
			$classname = "mController";
		}
		// Instantiate the controller
		$controller   = new $classname();
		
		try {
			// Perform the Request task
			$controller->execute($request->getValue("task"));
		} catch (Exception $e) {
			echo $e . " [controller=" . get_class($controller) . "]";
		}
	}

}
?>