<?php
/**
 * @version 		$Id: simplerosterdao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'contact.class.php');

class JLSimpleRostersDAO extends JLBaseDAO{
	
	//var $tablename = '#__jleague_roster';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSimpleRostersDAO();
		}
		return $instance;
	}		
	/**
	 * This function will create a new roster record in the database..
	 *
	 * @param JLRoster
	 * @return boolean
	 * @deprecated 
	 */
	function createRoster(JLRoster $roster) {
		return null;		
	}
	
	/**
	 * this function will allow a client to add a Player Object to a roster for the specified team and season (based on 
	 * their associated ID's.
	 *
	 * @param JLPlayer $player
	 * @param int $teamid
	 * @param int $seasonid
	 */	
    function addPlayerToRoster(JLPlayer $player,$teamid,$seasonid) {
		$query = 'INSERT INTO ' .$this->getNameQuote( "#__jleague_simple_roster" ) . ' (id,season,teamid,firstname, lastname) '
			. ' VALUES (0,'
			. '"' . $seasonid . '",'
			. '"' . $teamid . '",'
			. '"' . $player->getFirstName() . '",' 
			. '"' . $player->getLastName() . '"'
			.  ')';
		if (!$this->_insertRow($query)) {
			throw new Exception("Error adding player to roster");
		} 
    	
    }
    	
    /**
     * This function returns the total # of players defined on rosters for a given season.
     *
     * @param int $seasonid
     * @return int Total # of players
     */
    function getTotalPlayersForSeason($seasonid) {
    	$iid = (int) $seasonid;
    	$query = 'SELECT count(*) as total_players FROM #__jleague_simple_roster WHERE season = ' . $iid;
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->total_players;
    	}
    	return 0;
    }        	
   
    /**
     * This function returns the total # of rosters defined.
     *
     * @param int $seasonid
     * @return int Total # of teams with rosters
     */
    function getTotalRostersForSeason($seasonid) {
    	$iid = (int) $seasonid;
    	$query = 'SELECT distinct teamid FROM #__jleague_simple_roster WHERE season = ' . $iid;
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }        
        
    /*
    function updateRosterPlayer(JLPlayer $player, $teamid, $seasonid) {
    	require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers'. DS . 'util.php');
    	$newDate = JLUtil::dateConvert($player->getDateOfBirth(),1);    	
		
    	$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' player_name = "' . $player->getName(). '", '
			. ' player_number = "' . $player->getNumber() . '", '
			. ' date_of_birth = date("' . $newDate. '") '
			. ' WHERE ID = ' . $player->getId() . ' and teamid = ' . $teamid . ' and season = ' . $seasonid;
		return $this->_updateRow($query);		
    }
	*/
    
    
    /**
     * This function will delete a player from a teams roster based on the rosterid and the player id.
     *
     * @param int $rosterid
     * @param int $playerid
     */
    function removePlayerFromRoster($playerid) {
		$query = 'DELETE FROM ' .$this->getNameQuote( "#__jleague_simple_roster"  ) 
			. ' WHERE id = ' . $playerid;
		if (!$this->_deleteRow($query)) {
			throw new Exception("Error removing player from roster");
		} 
    }
         
    /**
     * This is a private function that retrieves the root portion of the roster object.  This will include
     * the team id and the season id.
     *
     * @param int $teamid
     * @param int $season
     * @return array
     */
//    private function getRosterRoot($teamid, $season) {
//	    $query = 'SELECT * from #__jleague_roster '
//	    	. '  where teamid = ' . $teamid . ' and season = ' . $season;
//    	$rows = self::_execute($query);
//    	return $rows;
//    }
    
    /**
     * This function will return a list of players assigned to the specific roster.
     *
     * @param int $rosterid
     * @return array
     */
//    private function getRosterPlayers($rosterid) {
//    	$query = 'SELECT p.* from #__jleague_players as p, #__jleague_rosterplayers as rp '
//	    	. '  where rp.playerid = p.id and rp.rosterid = ' . $rosterid ;
//    	$rows = self::_execute($query);
//    	return $rows;
//    }
    
    /**
     * This function will retrieve a team roster for a particular season.
     *
     * @param int $teamid
     * @param int $season
     * @return array
     */
    function getTeamRoster($teamid, $season) {
    	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'roster.class.php');
    	$query = 'SELECT * from #__jleague_simple_roster'
	    	. '  where teamid = ' . $teamid . ' and season = ' . $season . ' order by lastname, firstname';

    	$roster = new JLRoster();
    	$roster->setId("r" . $teamid . "-" . $season);
    	$roster->setSeason($season);
    	$roster->setTeamId($teamid);
    	
    	$rows = self::_execute($query);	

    	if ($rows != null) {
	    	foreach ($rows as $row) {
	    		$pobj = $this->loadPlayerObject($row);
	    		$roster->addPlayer($pobj);
	    	}
    	}
    	return $roster;
    }
    
    
    
    
    
	/**
	 * This function will populate a Player object.
	 *
	 * @param array $row
	 * @return JLPlayer
	 */	
	function loadPlayerObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'player.class.php');
		$obj = new JLPlayer();
		$obj->setId($row->id);
		$obj->setFirstName($row->firstname);
		$obj->setLastName($row->lastname);
		return $obj;
	}

}
