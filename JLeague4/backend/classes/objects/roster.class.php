<?php

/**
 * @version		$Id: roster.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'player.class.php');

class JLRoster extends JLBaseObject {
	
	private $id = null;
	private $teamid = null;
	private $season = null;
	private $players = null;
	
	function __construct() {
		parent::__construct();
		$this->players = array();	
	}
	
	function getId() {
		return $this->id;
	}
	function setId($inParm) {
		$this->id = $inParm;
	}

	function getTeamId() {
		return $this->teamid;
	}
	function setTeamId($teamid) {
		$this->teamid = $teamid;
	}	

	function getSeason() {
		return $this->season;
	}
	function setSeason($season) {
		$this->season = $season;
	}
	
	function getPlayers() {
		return $this->players;
	}
	function addPlayer(JLPlayer $player) {
		$this->players[] = $player;
	}
	
	function getPlayerCount() {
		return count($this->players);
	}
	
	function hasPlayers() {
		return count($this->players);
	}
}
?>
