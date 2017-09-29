<?php
/**
 * @version		$Id: sponsor.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'address.class.php');

class JLSponsor extends JLAddressObject  {
	
	private $id = null;
	private $name = null;
	private $sponsorname = null;
	private $contactname = null;
	private $contactphone = null;
	private $contactemail = null;
	private $campaigns = null;
	
	function __construct() {
		parent::__construct();
		$campaigns = array();
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
		
	function getContactName() {
		return $this->contactname;
	}
	function setContactName($name) {
		$this->contactname = $name;
	}
	function getContactPhone() {
		return $this->contactphone;
	}
	function setContactPhone($phone) {
		$this->contactphone = $phone;
	}
	function getContactEmail() {
		return $this->contactemail;
	}
	function setContactEmail($email) {
		$this->contactemail = $email;
	}
	function getNumberOfCampaigns() {
		return count($this->campaigns);
	}
	function setCampaigns(array $campaigns) {
		$this->campaigns = $campaigns;
	}
	function getCampaigns() {
		return $this->campaigns;
	}
}
?>