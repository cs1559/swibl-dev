<?php
/**
 * @version 		$Id: rosterdao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'contact.class.php');

class JLRostersDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_roster';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLRostersDAO();
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
		/*
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, season, teamid, datecreated) '
			. ' VALUES (0,'
			. '"' . $roster->getSeason(). '",' 
			. '"' . $roster->getTeamId() . '",'
			. 'now()'									
			.  ')';
		return $this->_insertRow($query);
		*/
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
    	$roster = $this->getRosterRoot($teamid, $seasonid);
    	$rosterid = 0;
    	if (sizeof($roster)>0) {
    		$rosterid = $roster[0]->id;
    	}	
    	if ($rosterid == 0) {
    		throw new Exception("ERROR:  Unknown Roster");
    	}
    	try {
    		$this->addPlayerToRosterByIds($rosterid, $player->getId());
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
    	
    	
    /**
     * This function will allow a client to add a player to a roster based on the roster id and the id of the 
     * player.
     *
     * @param int $rosterid
     * @param int $playerid
     */
    function addPlayerToRosterByIds($rosterid,$playerid) {
    	require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers'. DS . 'util.php');
    	//$newDate = JLUtil::dateConvert($player->getDateOfBirth(),1);    	
		$query = 'INSERT INTO ' .$this->getNameQuote( "#__jleague_rosterplayers" ) . ' (id,rosterid,playerid) '
			. ' VALUES (0,'
			. '"' . $rosterid . '",' 
			. '"' . $playerid . '"'
			.  ')';
		if (!$this->_insertRow($query)) {
			throw new Exception("Error adding player to roster");
		} 
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
    function removePlayerFromRoster($rosterid,$playerid) {
		$query = 'DELETE FROM ' .$this->getNameQuote( "#__jleague_rosterplayers"  ) 
			. ' WHERE rosterid = ' . $rosterid . ' and playerid = ' . $playerid;
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
    private function getRosterRoot($teamid, $season) {
	    $query = 'SELECT * from #__jleague_roster '
	    	. '  where teamid = ' . $teamid . ' and season = ' . $season;
    	$rows = self::_execute($query);
    	return $rows;
    }
    
    /**
     * This function will return a list of players assigned to the specific roster.
     *
     * @param int $rosterid
     * @return array
     */
    private function getRosterPlayers($rosterid) {
    	$query = 'SELECT p.* from #__jleague_players as p, #__jleague_rosterplayers as rp '
	    	. '  where rp.playerid = p.id and rp.rosterid = ' . $rosterid ;
    	$rows = self::_execute($query);
    	return $rows;
    }
    
    /**
     * This function will retrieve a team roster for a particular season.
     *
     * @param int $teamid
     * @param int $season
     * @return array
     */
    function getTeamRoster($teamid, $season) {
    	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'roster.class.php');
    	/*
	    $query = 'SELECT r.id as rosterid, r.teamid, r.season, p.*  '
	    	. ' from jos_jleague_roster r, jos_jleague_players p, jos_jleague_rosterplayers rp '
	    	. ' where rp.playerid = p.id and r.id = rp.rosterid '
	    	. '  and teamid = ' . $teamid . ' and season = ' . $season;
	    */	

    	$root = $this->getRosterRoot($teamid, $season);
    	$rosterid = 0;

    	if (sizeof($root)>0) {
    		$rosterid = $root[0]->id;
    	}
    	$roster = new JLRoster();
    	$roster->setId($rosterid);
    	$roster->setSeason($season);
    	$roster->setTeamId($teamid);
    	
    	$players = $this->getRosterPlayers($rosterid);
    	if ($players != null) {
	    	foreach ($players as $player) {
	    		$pobj = $this->loadPlayerObject($player);
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
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'util.php');

		$obj = new JLPlayer();
		$obj->setId($row->id);
		$obj->setFirstName($row->firstname);
		$obj->setLastName($row->lastname);
//		if (isset($row->player_number)) {
//			$obj->setNumber($row->player_number);
//		}
		$obj->setDateOfBirth(JLUtil::dateconvert($row->date_of_birth,2));
		$obj->setCity($row->city);
		$obj->setState($row->state);
		return $obj;
	}

}
