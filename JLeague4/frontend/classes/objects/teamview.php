<?php
/**
 * @version		$Id: teamview.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamcontact.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'venue.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'division.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'record.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'recordhistoryitem.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'roster.class.php');
// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'game.class.php');

class JLTeamView extends fsBaseObject {
	
	private $team = null;
	private $season = null;
	private $division = null;
	private $venues = null;
	private $roster = null;
	private $gamehistory = null;
	private $contacts = null;
	private $schedule = null;
	private $recordhistory = null;
	private $yearsinleague = null;
	private $activerecord = null;
	private $mostrecentgame = null;
	private $upcominggames = null;
	
	function __construct() {
		parent::__construct();
		$contacts = array();
		$fields = array();	
	}
	
	function setTeam(JLTeam $tm) {
		$this->team = $tm;
	}
	function getTeam() {
		return $this->team;
	}
	function getSeason() {
		return $this->team->getSeason();
	}
	function getDivision() {
		return $this->team->getDivision();
	}
	function setTeamContacts($contacts) {
		$this->contacts = $contacts;
	}
	function getTeamContacts() {
		return $this->contacts;
	}
	function setRoster($roster) {
		$this->roster = $roster;
	}
	function getRoster() {
		return $this->roster;
	}
	function setGameHistory($history) {
		$this->gamehistory = $history;
	}
	function getGameHistory() {
		return $this->gamehistory;
	}	
	function setRecordHistory($history) {
		$this->recordhistory = $history;
	}
	function getRecordHistory() {
		return $this->recordhistory;
	}
	function setMostRecentGame($game) {
		$this->mostrecentgame = $game;
	}
	function getMostRecentGame() {
		return $this->mostrecentgame;
	}
	function setUpcomingGames($games) {
		$this->upcominggames = $games;
	}
	function getUpcomingGames() {
		return $this->upcominggames;
	}	
	function setVenues($venues) {
		$this->venues = $venues;
	}
	function getVenues() {
		return $this->venues;
	}
	function setYearsInLeague($years) {
		$this->yearsinleague = $years;
	}
	function getYearsInLeague() {
		return $this->yearsinleague;
	}
	function getSchedule() {
		return $this->schedule;
	}
	function setSchedule($schedule) {
		$this->schedule = $schedule;
	}
	function setActiveRecord($rec) {
		$this->activerecord = $rec;
	}
	function getActiveRecord() {
			if (is_null($this->activerecord)) {
				echo "ACTIVE RECORD IS NULL";
			}
			if (sizeof($this->activerecord) < 1) {
				$arec = $this->recordhistory[0];
			} else {
				$arec = $this->activerecord;
			}
			return $arec;
	}
	function getFormattedRecord() {
			if (sizeof($this->activerecord) < 1) {
				$arec = $this->recordhistory[0];
				
			} else {
				$arec = $this->activerecord;
			}
			if ($arec == null) {
				return null;
			}
			return $arec->getWins() . "-" . $arec->getLosses() . "-" . $arec->getTies();
	}

}
?>