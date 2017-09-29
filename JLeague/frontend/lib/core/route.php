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

// include_once('exception.php');
// include_once('uri.php');
// include_once('property.php');

/**
 * The fsView is the foundation view that all views extend from.
 *
 */
class fsRoute {
	
	private $_params = null;
	
	function __construct(array $inArray) {
		$this->_params = $inArray;	
	}
	
	function getParameter($key) {
		if (isset($this->_params[$key])) {
			return $this->_params[$key];
		} 
		throw new Exception("Unknown route parameter");	
	}
	
}
?>
