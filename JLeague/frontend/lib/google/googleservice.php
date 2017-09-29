<?php
/**
 * @version		$Id: divisionservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

include_once('shorturl.php');
include_once('geocoder.php');

class fsGoogleService    {
	
	var $_key = null;
	
	protected function __construct($key) {
		//parent::__construct();
		$this->_key = $key;
	}
	
	function getInstance($key = "AIzaSyCwyCTcCrYwCNM1rE-Fxbbxh2fqUbvBXPk") {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new fsGoogleService($key);
		}
		return $instance;
	}

	function getUrlShortener() {
		$shortner = new fsGoogleUrlShortener($this->_key);
		return $shortner;
	}
	
	function getGeocoder() {
		$geocoder = new fsGoogleGeocoder($this->_key);
		return $geocoder;
	}
	
	function getKey() {
		return $this->_key;
	}
	
}

?>