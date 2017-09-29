<?php

/**
 * @version		$Id: address.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLAddressObject extends JLBaseObject {
	
	private $address1 = null;
	private $address2 = null;
	private $city = null;
	private $state = null;
	private $zipcode = null;
	
	function __construct() {
		parent::__construct();
	}
	
	function getAddress1() {
		return $this->address1;	
	}
	function setAddress1($addr1) {
		$this->address1 = $addr1;
	}
	function getAddress2() {
		return $this->address2;	
	}
	function setAddress2($addr2) {
		$this->address2 = $addr2;
	}
	function getCity() {
		return $this->city;
	}
	function setCity($city) {
		$this->city = $city;
	}
	function getState() {
		return $this->state;
	}
	function setState($state) {
		$this->state = $state;
	}
	function getZipcode() {
		return $this->zipcode;
	}
	function setZipcode($zipcode) {
		$this->zipcode = $zipcode;
	}
	
}
?>