<?php
/**
 * @version		$Id: divisionservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH .DS . 'baseservice.class.php');

class JLDivisionService  extends JLBaseService  {
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLDivisionService();
		}
		return $instance;
	}		
	
	protected function getDao() {
		$dao = &JLFactory::getDivisionDao();
		return $dao;
	}
	

	function getRow($id) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'season.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
				
		$cache = & JLCache::getInstance();
		$cache_key = 'DivisionService_getRow';
		try {
			$row = $cache->get($cache_key);
		} catch (Exception $e) {
			$row = parent::getRow($id);
			$cache->store($cache_key,$id,$row);
		}
		return $row;		
		
		//return parent::getRow($id);
	}
	
	function getCurrentDivisions() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'division.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
		
		$dao = $this->getDao();
		$config = JLConfig::getInstance();
		$filter_season = $config->getProperty('current_season');
		$filter[] =  ' season = ' . $filter_season;
		
		$cache = & JLCache::getInstance();
		$cache_key = 'getCurrentDivisions';
		try {
			$rows = $cache->get($cache_key);
		} catch (Exception $e) {
			$rows = $dao->getRecords(0,9999999999, 'ORDER BY season, sort_order', $filter);
			$cache->store($cache_key,$filter_season,$rows);
		}
		return $rows;
	}

	function getDivisionsForSeason($seasonid, $divid = null) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'division.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
		
		if (!is_numeric($seasonid)) {
			throw new  Exception("SeasonId is not numeric");
		}
		if ($divid != null) {
			if (!is_numeric($divid)) {
				throw new  Exception("DivisionId is not numeric");
			}
		}
		
		$dao = $this->getDao();
		$config = JLConfig::getInstance();
		$filter[] = ' season = ' . $seasonid;
		if ($divid != null) {
			$filter[] = ' id = ' . $divid;
		}
		//return $dao->getRecords(0,9999999999, 'ORDER BY season, sort_order', $filter);
		
		$cache = & JLCache::getInstance();
		$cache_key = 'getDivisionsForSeason_' . $seasonid . '_' . $divid;
		try {
			$rows = $cache->get($cache_key);
		} catch (Exception $e) {
			$rows = $dao->getRecords(0,9999999999, 'ORDER BY season, sort_order', $filter);
			$cache->store($cache_key,null,$rows);
		}
		return $rows;
		
	}
	
	function getCompetingTeamsJSON($divid = null) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		$recs = $this->getCompetingTeams($divid);
		$jsonarray = array();
		foreach ($recs as $rec) {
			$jsonarray[] = "{ optionValue: " . $rec->getId() . ", optionDisplay: '" . $rec->getName() . "'}";
		}
		$jsonstr = implode(",",$jsonarray);
		return "[" . $jsonstr . "]";
	}
		
	function getDivisionsForSeasonJSON($seasonid, $divid = null) {
		if (!is_numeric($seasonid)) {
			throw new  Exception("SeasonId is not numeric");
		}
		if ($divid != null) {
			if (!is_numeric($divid)) {
				throw new  Exception("DivisionId is not numeric");
			}
		}
		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		$recs = $this->getDivisionsForSeason($seasonid, $divid);
		$jsonarray = array();
		foreach ($recs as $rec) {
			$jsonarray[] = "{ optionValue: " . $rec->getId() . ", optionDisplay: '" . $rec->getName() . "'}";
		}
		$jsonstr = implode(",",$jsonarray);
		return "[" . $jsonstr . "]";
	}

	function getOtherDivisions($season,$divid) {
		if (!is_numeric($season)) {
			throw new  Exception("SeasonId is not numeric");
		}
		if (!is_numeric($divid)) {
			throw new  Exception("DivisionId is not numeric");
		}
		$dao = $this->getDao();
		return $dao->getOtherDivisions($season,$divid);
	}
	
	/**
	 * This function will a list of teams within a givne division.
	 *
	 * @param int $divid
	 * @return array
	 */
	function getTeamsInDivision($divid) {
		if (!is_numeric($divid)) {
			throw new  Exception("DivisionId is not numeric");
		}
		$dao = JLFactory::getTeamDao();
		return $dao->getTeamsInDivision($divid);	
	}
	/** 
	 * This function return an array of TEAM objects that compete toward league/conference
	 * games for a specific division.
	 *
	 * @param int $divid
	 */
	function getCompetingTeams($divid) {
		if (!is_numeric($divid)) {
			throw new  Exception("DivisionId is not numeric");
		}
		
		$division = $this->getRow($divid);
		
		$dao = $this->getDao();
		
		if ($division->getDivisionIdsInConferencePlay()!=null) {
			$otherdivkeys = explode(",",$division->getDivisionIdsInConferencePlay());
			foreach ($otherdivkeys as $key => $value) {
				$div = $dao->findById($value);
				$division->addDivisionInConferencePlay($div);	
			}
		}		
		$divisions = $division->getOtherDivisionsInConferencePlay();
		// Add current division to the array
		$divisions[] = $division;
		$dao = &JLFactory::getTeamDao();
		$teams = $dao->getTeamsInDivisions($divisions);
		return $teams;
	}
	
	function getNonCompetingTeams($divid) {
		if (!is_numeric($divid)) {
			throw new  Exception("DivisionId is not numeric");
		}
		
		$division = $this->getRow($divid);
		
		$dao = &JLTeamDAO::getInstance();

		$teams = $dao->getTeamsOutsideDivisionInAgeGroup($division);
		
		var_dump($teams);
		
	}
	
	/**
	 * This function will return all of the divisions within specific age groups
	 *
	 * @param unknown_type $season
	 * @param array $agegroups
	 * @return unknown
	 */
	function getDivisionsWithinAgeGroup($season, array $agegroups = null) {
		$dao = $this->getDao();
		$divisions = $dao->getDivisionsWithinAgeGroup($season, $agegroups);
		return $divisions;
	}
	
	function getCompetingDivisions($divid) {
		if (!is_numeric($divid)) {
			throw new  Exception("DivisionId is not numeric");
		}
		
		$division = $this->getRow($divid);
		
		$dao = $this->getDao();
		
		if ($division->getDivisionIdsInConferencePlay()!=null) {
			$otherdivkeys = explode(",",$division->getDivisionIdsInConferencePlay());
			foreach ($otherdivkeys as $key => $value) {
				$div = $dao->findById($value);
				$division->addDivisionInConferencePlay($div);	
			}
		}

		return $division->getOtherDivisionsInConferencePlay();
	}

	function getTeamConactsWithinDivision($divid) {
		$dao = &JLDivisionDAO::getInstance();
		try {
			$rows = $dao->getTeamConactsWithinDivision($divid);
			return $rows;		
		} catch (Exception $e) {
			throw $e;
		}
	}
	
}

?>