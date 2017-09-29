<?php
/**
 * @version 		$Id: standingsdao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'division.class.php');

class JLStandingsDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_standings';
	var $selectquery = "SELECT s.*,l.id as leagueid,l.name as leaguename, d.id as divisionid, d.name as divisionname, d.sort_order as divorder, seasons.id as seasonid, seasons.title as seasontitle FROM `#__jleague_standings` as s,
			`#__jleague_division` d, `#__jleague_leagues` l, `#__jleague_seasons` seasons 
			 where s.league_id = l.id 
				and s.division_id = d.id 
				and s.season = seasons.id";

	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLStandingsDAO();
		}
		return $instance;
	}
		
	/**
	 * 
	 * This function will insert a row into the DIVISION table.
	 *
	 * @param JLStanding
	 * @return boolean
	 */
   	function insert(JLStanding $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, league_id, season, division_id, position, team_id, teamname, wins, losses, ties, points, runs_scored, runs_allowed) '
			. ' VALUES (0,'
			. '"' . $obj->getLeagueId() . '",'
			. '"' . $obj->getSeason() . '",' 			 
			. '"' . $obj->getDivisionId() . '",'
			. '"' . $obj->getPosition(). '",'
			. '"' . $obj->getTeamId() . '",'
			. '"' . $obj->getTeamName() . '",'			
			. '"' . $obj->getWins() . '",'
			. '"' . $obj->getLosses() . '",'
			. '"' . $obj->getTies() . '",'			
			. '"' . $obj->getPoints() . '",'
			. '"' . $obj->getRunsScored() . '",'						
			. '"' . $obj->getRunsAllowed() . '"'									
			.  ')';
		try {			
			$this->_insertRow($query);
			return true;
		} catch (Exception $e) {
			throw $e;			
		}
    }
    
    /**
     * This function will enable someone to delete a row from the LEAGUE table.
     *
     * @param JLStanding $league
     * @return boolean
     */
    function update(JLStanding $obj) {
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' league_id = "' . $obj->getLeagueId(). '", '
			. ' season = "' . $obj->getWebsite(). '", '
			. ' division_id = "' . $obj->getCity(). '", '
			. ' position = "' . $obj->getState(). '", '	
			. ' team_id = "' . $obj->getLogo(). '", '
			. ' teamname = "' . $obj->getTeamName(). '", '
			. ' wins = "' . $obj->getWins(). '", '
			. ' ties = "' . $obj->getTies(). '", '
			. ' losses = "' . $obj->getTies(). '", '													
			. ' points = "' . $obj->getPoints(). '" '
			. ' runs_scored = "' . $obj->getRunsScored().  '" '
			. ' runs_allowed = "' . $obj->getRunsAllowed() .'" '			
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }

        
    /**
     * This function will return an array of JLStanding objects.
     *
     * @param int $start
     * @param int $stop
     * @param String $orderby
     * @param String $filter
     * @return array
     */
	function getRecords($start, $stop, $orderby = '', $filter = '') {
		$where = '';
		$cond = $this->createFilterWhereClase($filter);
		if ($cond != null) {
			$where = ' where ' . $cond;
		}
		$setlimit = false;
		if (((int) $start) > 0) {
			$setlimit = true;
		}
		if (((int) $stop) > 0) {
			$setlimit = true;
		}

		$orderby = 'order by leagueid, divorder,  divisionid, seasonid, position ';	
		if (sizeof($filter)>0) {
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . $where . ' ' . $orderby;
			if ($setlimit) { 
				$query .= ' LIMIT ' . $start . ',' . $stop;
			}
			return parent::_getRows($query);						
		} else {
			return parent::_getRows($this->selectquery);
		}
 	} 	    
    
 	/**
 	 * This function will retrieve the standings for a specific league, season and division.
 	 *
 	 * @param int $leagueid
 	 * @param int $seasonid
 	 * @param int $divisionid
 	 * @return array
 	 */
 	function getStandings($leagueid = null,$seasonid = null, $divisionid = null) {
 		$filter = array();
 		if ($leagueid > 0) {
			$filter[] = "leagueid = " . $leagueid;
		}
		if ($seasonid > 0) {
			$filter[] = "seasonid = " . $seasonid;
		} 		
		if ($divisionid > 0) {
			$filter[] = "divisionid = " . $divisionid;
		} 		
 		return $this->getRecords(0,0,'',$filter);
 	}
 	
 	function getActiveStandings($leagueid=null,$seasonid=null,$division=null) {
 		
 	}
	
	function getTableSize($filter=null) {
		$where = '';
		$cond = $this->createFilterWhereClase($filter);
		if ($cond != null) {
			$where = ' where ' . $cond;
		}
		if (sizeof($filter)>0) {		
			$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as s, #__jleague_divmap as dm '
				. $where . ' and t.id = dm.team_id ';
		} else {
			return parent::getTableSize($where);
		}
	 	$db			=& JLApp::getDBO();
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return sizeof($rows); 
  } 	
    
	
	/**
	 * This function will return an array of objects for ALL rows within the underlying
	 * table.
	 *
	 * @return array
	 */
  	function getRows() {
		return self::_getRows($this->selectquery);
	}	
  
	protected function createFilterWhereClase($filter) {
		if (sizeof($filter)>0) {
			$value = implode(" and ",$filter);
			return $value;
		}
		return '';
	}
	
	/**
	 * This will map the the database row to the Standing Object
	 *
	 * @param unknown_type $row
	 * @return JLStanding
	 */	
	protected function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'standing.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');
		$obj = new JLStanding();
		$obj->setId($row->id);
		$obj->setTeamId($row->team_id);
		$obj->setPosition($row->position);
		$obj->setLeagueId($row->leagueid);
		$obj->setDivisionId($row->divisionid);
		$obj->setSeason($row->seasonid);
		$obj->setTeamName($row->teamname);
		$obj->setWins($row->wins);
		$obj->setLosses($row->losses);		
		$obj->setTies($row->ties);
		$obj->setPoints($row->points);
		$obj->setRunsAllowed($row->runs_allowed);
		$obj->setRunsScored($row->runs_scored);
		$obj->setLeagueName($row->leaguename);
		$obj->setDivisionName($row->divisionname);
		$obj->setSeasonName($row->seasontitle);
		return $obj;
	}

}
