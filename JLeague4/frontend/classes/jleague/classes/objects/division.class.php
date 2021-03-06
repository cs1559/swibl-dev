<?php
/**
 * @version		$Id: division.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');
/**
 * The Division class represents an entity within the League
 *
 */
class JLDivision extends JLBaseObject {

	var $id=null;
	var $name=null;
	var $league_id=null;
	var $league_division=null;
	var $season_id = null;
	var $sortorder= null;
	var $published = null;
	var $league = null;
	var $season = null;
	var $age = null;
	var $primarycontactid = null;
	var $secondarycontactid = null;
	var $primarycontact = null;
	var $secondarycontact = null;
	var $divisionsinconferenceplay_raw = null;
	var $divisionsinconferenceplay = null;
	var $notes = null;
	var $games = null;
	
	function __construct() {
		parent::__construct();
		$this->divisionsinconferenceplay = array();
	}
	
	function setId($inParm) {
		$this->id = $inParm;
	}
	function getId() {
		return $this->id;
	}

	function setName($inParm) {
		$this->name = $inParm;
	}
	function getName() {
		return $this->name;
	}

	function setLeagueId($inParm) {
		$this->league_id = $inParm;
	}
	function getLeagueId() {
		return $this->league_id;
	}
	function setSeasonId($inParm) {
		$this->season_id = $inParm;
	}
	function getSeasonId() {
		return $this->season_id;
	}

	function setOrder($inParm) {
		$this->sortorder=$inParm;
	}
	function getOrder() {
		return $this->sortorder;
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
	
	function setLeague(JLLeague $league) {
		$this->league = $league;
	}
	function getLeague() {
		return $this->league;
	}
	
	function setSeason(JLSeason $season) {
		$this->season = $season;
	}
	function getSeason() {
		return $this->season;
	}
	function setAgeGroup($age) {
		$this->age = $age;
	}
	function getAgeGroup() {
		return $this->age . "U";
	}
	function setNumberOfGames($games) {
		$this->games = $games;
	}
	/**
	 * Returns the number of games targeted to be played by each team within a 
	 * specific division.
	 *
	 * @return int
	 */
	function getNumberOfGames() {
		return $this->games;
	}
	function setPrimaryContactId($id) {
		$this->primarycontactid = $id;
	}
	function getPrimaryContactId() {
		return $this->primarycontactid;
	}
	function setSecondaryContactId($id) {
		$this->secondarycontactid = $id;
	}
	function getSecondaryContactId() {
		return $this->secondarycontactid;
	}	
	function setPrimaryContact(JLContact $contact) {
		$this->primarycontact = $contact;
	}
	function getPrimaryContact() {
		return $this->primarycontact;
	}
	function setSecondaryContact(JLContact $contact) {
		$this->secondarycontact = $contact;
	}
	function getSecondaryContact() {
		return $this->secondarycontact;
	}
	/**
	 * The value here should be a comma delimited list of divisions within conference play
	 *
	 */
	function setDivisionIdsInConferencePlay($divids) {
		$this->divisionsinconferenceplay_raw = $divids;
	}
	function getDivisionIdsInConferencePlay() {
		return $this->divisionsinconferenceplay_raw;
	}
	/**
	 * This function will add a division object to the array of divisions that fall into this divisions 
	 * conference play.
	 *
	 * @param JLDivision $div
	 */
	function addDivisionInConferencePlay(JLDivision $div) {
		$this->divisionsinconferenceplay[] = $div;
	}
	/**
	 * Returns an array of Division objects that are to be counted in conference play.
	 *
	 * @return array
	 */
	function getOtherDivisionsInConferencePlay() {
		return $this->divisionsinconferenceplay;
	}
	
	/**
	 * This is a helper functino that will test a particular division id to see if any secondary
	 * divisions should be included in this particular divisions "league" play.
	 *
	 * @param int $odiv
	 * @return boolean
	 */
	function includeInConferencePlay($odiv) {
		$otherdivkeys = explode(",",$this->divisionsinconferenceplay_raw);
		foreach ($otherdivkeys as $div) {
			if ($div == $odiv) {
				return true;
			}
		}
		return false;
	}

	function setNotes($inParm) {
		$this->notes = $inParm;
	}
	function getNotes() {
		return $this->notes;
	}
	
	
}
 
?>
