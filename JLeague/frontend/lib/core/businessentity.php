<?php

/**
 * @version		$Id: baseobject.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */
// Disallow direct access to this fileAddress
defined('_FSTLIB') or die('Restricted access');

class fsBusinessEntity extends fsBaseObject {
	
	private $address = null;
	private $phone = null;
	
	function __construct() {
		parent::__construct();
		$this->address = new fsAddress();
	}
	
	function getAddress() {
		return $this->address;
	}
	
	function getAddress1() {
		return $this->address->getAddress1();
	}
	function setAddress1($addr1) {
		$this->address->setAddress1($addr1);
	}
	function getAddress2() {
		return $this->address->getAddress2();
	}
	function setAddress2($addr2) {
		$this->address->setAddress2($addr2);
	}
	function getCity() {
		return $this->address->getCity();
	}
	function setCity($city) {
		$this->address->setCity($city);
	}
	function getState() {
		return $this->address->getState();
	}
	function setState($state) {
		$this->address->setState($state);
	}	
	function getZipcode() {
		return $this->address->getZipcode();
	}
	function setZipcode($zipcode) {
		$this->address->setZipcode($zipcode);
	}
	function getPhone() {
		return $this->phone;
	}
	function setPhone($phone) {
		$this->phone = $phone;
	}
	
}