<?php
/**
 * @version		$Id: season.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLBulletin extends fsBaseObject  {

	var $id = null;
	var $category = null;
	var $teamid = null;
	var $ownerid = null;
	var $sponsorid = null;
	var $title = null;
	var $type = null;
	var $createdate = null;
	var $description = null;
	var $published = null;
	var $contactname = null;
	var $contactphone = null;
	var $contactemail = null;
	
	public static $BULLETIN_GENERAL = 1;
	public static $BULLETIN_TRYOUT = 2;
	public static $BULLETIN_SPONSOR = 3;
	public static $BULLETIN_TOURNAMENT = 4;
	public static $BULLETIN_TEAM = 5;
	
	function __construct() {
    	parent::__construct();
    	$this->id = 0;
    }
    
    function setId($inParm) {
    	$this->id = $inParm;
    }
    function getId() {
    	return $this->id;
    }
    
    function setTeamId($inId) {
    	$this->teamid = $inId;
    }
    function getTeamId() {
    	return $this->teamid;
    }

    function setSponsorId($inId) {
    	$this->sponsorid = $inId;
    }
    function getSponsorId() {
    	return $this->sponsorid;
    }
    
    function setOwnerId($inId) {
    	$this->ownerid = $inId;
    }
    function getOwnerId() {
    	return $this->ownerid;
    }
    
    function setCreateDate($inparm) {
    	$this->createdate = $inparm;
    }
    function getCreateDate() {
    	return $this->createdate;
    }
    function setCategory($cat) {
    	$this->category = $cat;
    }
    function getCategory() {
    	return $this->category;
    }
    function setType($inType) {
    	$this->type = $inType;
    }
    function getType() {
    	return $this->type;
    }
    function getTypeDesc() {
    	switch ($this->getType()) {
    		case 1:
    			return "General";
    			break;
    		case 2:
    			return "Tryout";
    			break;
    		case 3:
    			return "Sponsor";
    			break;
    		case 4:
    			return "Tournament";
    			break;
    		default:
    			return "";
    	}
    }
    function setTitle($inParm) { 
    	$this->title = $inParm;
    }
    function getTitle() {
    	return $this->title;
    }
    function setDescription($inParm) {
    	$this->description = $inParm;
    }
    function getDescription() {
    	return $this->description;
    }
	
	/**
	 * This will set the published indicator
	 *
	 * @param boolean $inParm
	 */
	function setPublished($inParm) {
		$this->published = $inParm;
	}
	
	/**
	 * This will return a boolean indicating whether or not the league is published
	 *
	 * @return boolean
	 */
	function getPublished() {
		return $this->published;
	}
    

	public function getContactName() {
		return $this->contactname;
	}
	public function setContactName($cname) {
		$this->contactname = $cname;
	}
	public function getContactPhone() {
		return $this->contactphone;
	}
	public function setContactPhone($phone) {
		$this->contactphone = $phone;
	}
	public function getContactEmail() {
		return $this->contactemail;
	}
	public function setContactEmail($email) {
		$this->contactemail = $email;
	}
	
	
}
?>