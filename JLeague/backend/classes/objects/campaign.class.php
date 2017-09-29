<?php
/**
 * @version		$Id: campaign.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLCampaign extends JLBaseObject  {

	private $id = null;
	private $sponsorid = null;
	private $name = null;
	private $notes = null;
	private $startdate = null;
	private $enddate = null;
	private $clickthru = null;
	private $clicks = null;
	private $published = null;
	
    function setId($inParm) {
    	$this->id = $inParm;
    }
    function getId() {
    	return $this->id;
    }
    function setSponsorId($id) {
    	$this->sponsorid = $id;	
    }
    function getSponsorId() {
    	return $this->sponsorid;
    }
    function setName($name) {
    	$this->name = $name;	
    }
    function getName() {
    	return $this->name;
    }
    function setNotes($notes) {
    	$this->notes = $notes;
    }
    function getNotes() {
    	return $this->notes;
    }
    function setStartDate($date) {
    	$this->startdate = $date;
    }
    function getStartDate() {
    	return $this->startdate;
    }
    function setEndDate($date) {
    	$this->enddate = $date;
    }
    function getEndDate() {
    	return $this->enddate;
    }
    function setClickthru($url) {
    	$this->clickthru = $url;
    }
    function getClickthru() {
    	return $this->clickthru;
    }    
    function setClicks($cnt) {
    	$this->clicks = $cnt;
    }
    function getClicks() {
    	return $this->clicks;
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
    
}

?>