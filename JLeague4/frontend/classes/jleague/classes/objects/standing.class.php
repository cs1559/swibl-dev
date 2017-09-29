<?php
/**
 * @version		$Id: standing.class.php 434 2012-06-01 00:45:54Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'season.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'division.class.php');	


class JLStanding extends JLBaseObject  {

	private $id = null;
	private $leagueid = null;
	private $divisionid = null;
	private $season = null;
	private $position = null;
	private $teamid = null;
	private $teamname = null;
	private $wins = null;
	private $losses = null;
	private $ties = null;
	private $points = null;
	private $runsscored = 0;
	private $runsallowed = 0;
	private $leaguename = null;
	private $divisionname = null;
	private $seasonname = null;
	
    function setId($inParm) {
    	$this->id = $inParm;
    }
    function getId() {
    	return $this->id;
    }
    function setLeagueId($id) {
    	$this->leagueid = $id;	
    }
    function getLeagueId() {
    	return $this->leagueid;
    }
    function setDivisionId($id) {
    	$this->divisionid = $id;	
    }
    function getDivisionId() {
    	return $this->divisionid;
    }
    function setSeason($season) {
    	$this->season = $season;	
    }
    function getSeason() {
    	return $this->season;
    }
    function setPosition($pos) {
    	$this->position = $pos;
    }
    function getPosition() {
    	return $this->position;
    }
    function setTeamId($id) {
    	$this->teamid = $id;
    }
    function getTeamId() {
    	return $this->teamid;
    }
    function setTeamName($name) {
    	$this->teamname = $name;
    }
    function getTeamName() {
    	return $this->teamname;
    }
    function setWins($wins) {
    	$this->wins = $wins;
    }
    function getWins() {
    	return $this->wins;
    }
    function setLosses($losses) {
    	$this->losses = $losses;
    }
    function getLosses() {
    	return $this->losses;
    }
    function setTies($ties) {
    	$this->ties = $ties;
    }
    function getTies() {
    	return $this->ties;
    }
    function setPoints($points) {
    	$this->points = $points;
    }
    function getPoints() {
    	return $this->points;
    }
    function setRunsScored($scored){
    	$this->runsscored = $scored;
    }
    function getRunsScored() {
    	return $this->runsscored;
    }
    function setRunsAllowed($allowed) {
    	$this->runsallowed = $allowed;
    }
    function getRunsAllowed() {
    	return $this->runsallowed;
    }
    function getTotalGames() {
    	$wins = (int) $this->getWins();
    	$losses = (int) $this->getLosses();
    	$ties = (int) $this->getTies();
    	return $wins + $losses + $ties;
    }
    function getWinningPercentage() {
    	$wins = (float) $this->getWins();
    	$ties = (float) $this->getTies() * .5;
    	$total = $wins + $ties;
    	if ($this->getTotalGames() > 0) {
    		return (float) $total / $this->getTotalGames();
    	} else {
    		return 0;
    	}
    		
    }
    function getSlug() {
    	return parent::getSlug($this->teamid, $this->teamname);
    }

    function setLeagueName($name) {
    	$this->leaguename = $name;
    }
	function getLeagueName() {
    	return $this->leaguename;
    }
    function setDivisionName($name) {
    	$this->divisionname = $name;
    }
	function getDivisionName() {
    	return $this->divisionname;
    }
    function setSeasonName($name) {
    	$this->seasonname = $name;
    }
	function getSeasonName() {
    	return $this->seasonname;
    }
    
}

?>