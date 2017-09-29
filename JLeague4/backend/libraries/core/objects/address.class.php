<?php

/**
 * @version		$Id: address.class.php 53 2010-02-24 23:27:08Z Chris Strieter $
 * @package 	FSTCore
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	Commercial
 * 
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(FST_CORE_OBJECTS_PATH . DS . 'baseobject.class.php');

class FSTAddress extends FSTBaseObject {
	
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