<?php

/**
 * @version		$Id: recordhistoryitem.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'record.class.php');

class JLRecordHistoryItem extends JLRecord  {
	
	private $teamid = null;
	private $teamname = null;
	private $divid = null;
	private $divname = null;
	private $seasonid = null;
	private $season = null;
	private $runs_scored = 0;
	private $runs_allowed = 0;
	
	public function getTeamId() {
		return $this->teamid;
	}
	public function setTeamId($id) {
		$this->teamid = $id;
	}
	public function getTeamName() {
		return $this->teamname;
	}
	public function setTeamName($name) {
		$this->teamname = $name;
	}
	public function getDivisionId() {
		return $this->divid;
	}
	public function setDivisionId($id) {
		$this->division = $id;
	}
	public function getDivisionName() {
		return $this->divname;
	}
	public function setDivisionName($name) {
		$this->divname = $name;
	}
	
	public function getSeasonId() {
		return $this->seasonid;
	}
	public function setSeasonId($id) {
		$this->seasonid = $id;
	}
	public function getSeason() {
		return $this->season;
	}
	public function setSeason($name) {
		$this->season = $name;
	}
	
	public function getRunsScored() {
		return $this->runs_scored;
	}
	public function setRunsScored($scored) {
		$this->runs_scored = $scored;
	}
	public function getRunsAllowed() {
		return $this->runs_allowed;
	}
	public function setRunsAllowed($allowed) {
		$this->runs_allowed = $allowed;
	}
	public function getWinningPercentage() {
		$wins = (float) $this->getWins();
		$ties = (float) $this->getTies() * .5;
		$total = $wins + $ties;
		if ($this->getTotalGames() > 0) {
			return (float) $total / $this->getTotalGames();
		} else {
			return 0;
		}
	}
	public function getAverageRunsAllowed() {
		// echo $obj->getRunsScored() - $obj->getRunsAllowed();
		if ($this->getTotalGames() > 0) {
			$avgra = $this->getRunsAllowed() / $this->getTotalGames();
		} else {
			$avgra = 0;
		}
		return number_format($avgra,3);
	}
	
	
}

?>