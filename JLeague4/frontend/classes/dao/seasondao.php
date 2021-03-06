<?php
/**
 * @version 		$Id: seasondao.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

// require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
// require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'season.class.php');
// require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers'. DS . 'util.php');

class JLSeasonDAO extends fsBaseDAO{
	
	var $tablename = '#__jleague_seasons';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSeasonDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}	
	/**
	 * 
	 * This function will insert a row into the SEASON table.
	 *
	 * @param JLSeason $league
	 * @return boolean
	 */
   	function insert(JLSeason $obj) {
    	$newStartDate = JLUtil::dateConvert($obj->getRegistrationStart(),1);
    	$newEndDate = JLUtil::dateConvert($obj->getRegistrationEnd(),1);
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, title, description, active, registrationopen, status, ' 
			. ' registrationonly, registrationtemplate, registrationnotes, properties, publishstandings, setupfinal, published) '
			. ' VALUES (0,'
			. '"' . $obj->getTitle() . '",' 
			. '"' . $obj->getDescription() . '",'
			. '"' . $obj->getActive() . '",'
			. '"' . $obj->isRegistrationOpen() . '",'
			. '"P",'
			. '"' . $obj->isRegistrationOnly() . '",'
			. '"' . $obj->getRegistrationTemplate() . '",'
			. '"' . $obj->getRegistrationNotes() . '",'
//			. ' date("' . $newStartDate. '"), '
//			. ' date("' . $newEndDate. '"), '						
			. '"' . $obj->getFormattedProperties() . '",'
			. '"' . $obj->getPublishStandings() . '",'
			. '"' . $obj->isSetupFinal() . '",'
			. $obj->getPublished() . ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to update a row from the Season table.
     *
     * @param JLSeason $obj
     * @return boolean
     */
    function update(JLSeason $obj) {
    	$newStartDate = JLUtil::dateConvert($obj->getRegistrationStart(),1);
    	$newEndDate = JLUtil::dateConvert($obj->getRegistrationEnd(),1);
		$query = 'update ' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' title = "' . $obj->getTitle(). '", '
			. ' description = "' . $obj->getDescription(). '", '
			. ' active = "' . $obj->getActive(). '", '
			. ' registrationopen = "' . $obj->isRegistrationOpen(). '", '
			. ' registrationonly = "' . $obj->isRegistrationOnly(). '", '
			. ' registrationtemplate = "' . $obj->getRegistrationTemplate(). '", '
			. ' registrationnotes = "' . $obj->getRegistrationNotes(). '", '
//			. ' date("' . $newStartDate. '"), '
//			. ' date("' . $newEndDate. '"), '
			. ' status = "' . $obj->getStatus(). '", '
			. ' properties = "' . $obj->getFormattedProperties() . '", '
			. ' publishstandings = "' . $obj->getPublishStandings() . '", '
			. ' setupfinal = "' . $obj->isSetupFinal() . '", '
			. ' published = ' . $obj->getPublished()
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }
	
 	/**
 	 * This function will return the number of divisions for a season
 	 * This function will filter the REGISTRANTS TO only those who have been published.
 	 * 
 	 * @param int Season Id
 	 * @return int
 	 */
    function getTotalDivisionsForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT * FROM #__jleague_division WHERE published = 1 and season = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }
    
    
    /**
     * This function will return the number of games for a season
     *
     * @param int Season Id
     * @return int
     */
    function getTotalTeamsByDivisionForSeason($id) {
    	$iid = (int) $id;
    	$query = 'select ts.name as division_name,ts.sort_order,count(*) as team_count
from #__jleague_divmap as dm 
left join (
	select * from #__jleague_division
) as ts
on dm.division_id = ts.id
where dm.season = '  . $iid . '
and dm.published = 1
group by ts.sort_order, ts.name
order by ts.sort_order, ts.name';
    	$rows = $this->_execute($query);
    	return $rows;
    }
	
 	/**
 	 * This function will return the number of games for a season
 	 * 
 	 * @param int Season Id
 	 * @return int
 	 */
    function getTotalGamesForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT count(*) as total_games FROM #__jleague_scores WHERE gamestatus = "C" and season = ' . $iid;
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->total_games;
    	}
    	return 0;
    }
        
	
 	/**
 	 * This function will return the number of games for a season
 	 * 
 	 * @param int Season Id
 	 * @return int
 	 */
    function getTotalLeagueGamesForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT count(*) as total_games FROM #__jleague_scores WHERE gamestatus = "C" and conference_game = "Y" and season = ' . $iid;
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->total_games;
    	}
    	return 0;
    }
    
    function getTotalLeagueGamesScheduled($id) {
    	$iid = (int) $id;
    	$query = 'SELECT count(*) as total_games FROM #__jleague_scores WHERE conference_game = "Y" and season = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return $rows[0]->total_games;
    	}
    	return 0;
    }
    
 	/**
 	 * This function will return the number of divisions for a season
 	 * This function will filter the REGISTRANTS TO only those who have been published.
 	 * 
 	 * @param int Season Id
 	 * @return int
 	 */
    function getTotalTeamsForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT distinct team_id FROM #__jleague_divmap WHERE published = 1 and season = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }    

    function getTotalPaidTeamsForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT distinct team_id FROM #__jleague_divmap WHERE paid = 1 and season = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }    
    
    
    function getTotalRegistrationsForSeason($id) {
    	$iid = (int) $id;
    	$query = 'SELECT * FROM #__jleague_divmap WHERE season = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }    
    
    
    /**
     * This function will return an array of Season objects that are available for registration.
     *
     * @return unknown
     */
    function getSeasonsOpenForRegistration() {
    	$query = "select * from #__jleague_seasons where published = 1 and registrationopen = 1";
    	return parent::_getRows($query);
    }    
    
 	/**
 	 * This function will return the most recent season.  It will first try to retrieve any active
 	 * season and if one is not found, then it returns the most recent closed or PENDING season.
 	 * 
 	 * @param int Season Id
 	 * @return JLSeason
 	 */
    function getMostRecentSeason() {
//    	try {
//    		$season = $this->getActiveSeason();
//    		return $season;
//    	} catch (Exception $e) {
			// $query = 'SELECT * FROM #__jleague_seasons WHERE title = (SELECT max( title ) FROM #__jleague_seasons where status in ("C","P") and registrationonly <> 1 and  published = 1 )';
	    	$query = 'SELECT * FROM #__jleague_seasons WHERE title = (SELECT max( title ) FROM #__jleague_seasons where status in ("C","A") and (registrationonly <> 1 or registrationonly is null) and  published = 1 )';
    		$rows = $this->_execute($query);
    		return $this->loadObject($rows[0]);
//    	}
    }    
    
    /**
     * This function will return the most recent active season
     *
     * @return JLSeason
     */
    function getActiveSeason() {
    	$query = 'SELECT * FROM #__jleague_seasons WHERE title = (SELECT max( title ) FROM #__jleague_seasons where active = 1 or status = "A")';
    	$rows = $this->_execute($query);
    	if (sizeof($rows) > 0) {
    	return $this->loadObject($rows[0]);
    	} else {
    	//	return $this->getMostRecentSeason();
    		throw new Exception("No Active season found");
    	}
    } 

	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		
		$obj = new JLSeason();
		$obj->setId($row->id);
		$obj->setTitle($row->title);
		$obj->setDescription($row->description);
		$obj->setActive($row->active);
		$obj->setPublished($row->published);
		$obj->setStatus($row->status);
		
		$obj->setRegistrationOpen($row->registrationopen);
		$obj->setRegistrationEnd($row->registrationend);
		$obj->setRegistrationStart($row->registrationstart);
		$obj->setRegistrationTemplate($row->registrationtemplate);    // used to define registration template form
		$obj->setRegistrationOnly($row->registrationonly);    // used for collecting registration data only
		$obj->setRegistrationNotes($row->registrationnotes);
		$obj->parseDatabaseObjectProperties($row->properties);
		$obj->setPublishStandings($row->publishstandings);
		$obj->setSetupFinal($row->setupfinal);
		
		$totaldivs = $this->getTotalDivisionsForSeason($row->id);
		$totalteams = $this->getTotalTeamsForSeason($row->id);
		$totalgames = $this->getTotalGamesForSeason($row->id);
		$totalleaguegames = $this->getTotalLeagueGamesForSeason($row->id);
		$totalregistrations = $this->getTotalRegistrationsForSeason($row->id);
		$totalscheduled = $this->getTotalLeagueGamesScheduled($row->id);
		$totalpaid = $this->getTotalPaidTeamsForSeason($row->id);
		
		$obj->setTotalDivisions($totaldivs);
		$obj->setTotalTeams($totalteams);
		$obj->setTotalGames($totalgames);
		$obj->setTotalLeagueGames($totalleaguegames);
		$obj->setTotalRegistrations($totalregistrations);
		$obj->setTotalScheduledGames($totalscheduled);
		$obj->setTeamsPaid($totalpaid);
		
		return $obj;
	}

}
