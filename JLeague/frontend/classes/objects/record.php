<?php

/**
 * @version		$Id: record.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLRecord extends fsBaseObject {

	private $id=null;			
  	private $name=null;
	private $season=null;
	private $wins=0;
	private $losses=0;
	private $ties=0;
  	private $points=0;

	function getFormattedRecord() {
	  return "(" . $this->wins . "-" . $this->losses . "-" . $this->ties . ")";
	}

	function getSeason() {
		return $this->season;
	}
	function setSeason($season) {
		$this->season = $season;
	}
	function getWins() {
		return $this->wins;
	}
	function setWins($wins) {
		$this->wins = $wins;
	}
	function getLosses() {
		return $this->losses;
	}
	function setLosses($losses) {
		$this->losses = $losses;
	}
	function getTies() {
		return $this->ties;
	}
	function setTies($ties) {
		$this->ties = $ties;
	}	
	function getTotalGames() {
		return $this->getWins() + $this->getTies() + $this->getLosses();
	}
} 


