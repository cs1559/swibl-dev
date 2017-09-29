<?php

/**
 * @version		$Id: contact.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLContact extends fsBaseObject {
	
	var $id = null;
	var $name = null;
	var $email = null;
	var $phone = null;
	var $cellphone = null;
	var $role = null;
	private $userid = null;
	
	function __construct() {
		parent::__construct();	
	}
	
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

	function getEmail() {
		return $this->email;
	}
	function setEmail($email) {
		$this->email = $email;
	}
	
	function getPhone() {
		return $this->phone;
	}
	function setPhone($phone) {
		$this->phone = $phone;
	}
	function getCellPhone() {
		return $this->cellphone;
	}
	function setCellPhone($phone) {
		$this->cellphone = $phone;
	}	
	function getRole() {
		return $this->role;
	}
	function setRole($role) {
		$this->role = $role;
	}
	
	function getUserid() {
		return $this->userid;	
	}
	function setUserid($uid) {
		$this->userid = $uid;
	}
	
}
?>