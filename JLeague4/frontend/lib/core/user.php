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

/**
 * The USER class is a base object to represent a user of a given system/application.
 */

class fsUser extends fsBaseObject {
	
	private $id = null;
	private $username = null;
	private $name = null;
	private $email = null;
	private $password = null;
	
	/* Construct the object */
	function __construct() {
		parent::__construct();
		// Always set the ID to zero when the object is constructed
		$this->id = 0;
	}
	
	/**
	 * Set the ID of the user 
	 * @param unknown $inParm
	 */
	function setId($inParm) {
		$this->id = $inParm;
	}
	function getId() {
		return $this->id;
	}
	
	/**
	 * Get/Set the username associated with the user account
	 */
	function getUsername() {
		return $this->username;
	}
	function setUsername($name) {
		$this->username = $name;
	}
	
	/**
	 * Get/Set the password of the user
	 */
	function getPassword() {
		return $this->password;
	}
	function setPassword($pwd) {
		$this->pwd = $pwd;
	}
	
	/**
	 * Get/Set the actual user name 
	 */
	function getName() {
		return $this->name;
	}
	function setName($name) {
		$this->name = $name;
	}
	/**
	 * Get/Set the email address of the user
	 */
	function getEmail() {
		return $this->email;
	}
	function setEmail($email) {
		$this->email = $email;
	}
	
}
?>