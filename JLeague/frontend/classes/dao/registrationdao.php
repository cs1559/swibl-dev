<?php
/**
 * @version 		$Id: registrationdao.class.php 416 2012-02-12 20:35:03Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLRegistrationDAO extends fsBaseDAO{
	
	var $tablename = '#__jleague_divmap';

	var $selectquery = '
			select d.*, s.title as seasontitle from 
			(
			select dm.*, d.name divisionname
			from #__jleague_divmap as dm
			left join #__jleague_division as d on dm.division_id = d.id
			) as d, #__jleague_seasons s
			where s.id = d.season
			   ';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLRegistrationDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}

	/**
	 * Delete an individual TEAM registration.
	 *
	 * @param int $id
	 */
	function delete($id) {
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		$iid = (int) $id;
		$reg = self::findById($id);
		
		$app = &mFactory::getApp();
		$config = $app->getConfig();
		//@todo Check to see if season ins't current.  previous seasons should be locked.
		if ($reg->getSeasonId() < $config->getPropertyValue('current_season')) {
			throw new Exception("Cannot delete registrations rows from previous seasons");
			return;
		}
		//@todo Need to check to ensure there are no existing games 
		$query	= 'delete from ' .$this->getNameQuote( $this->tablename  ) . ' where id = ' . $iid	;

		try {
			parent::delete($id);
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	function findById($id) {
		$iid = (int) $id;
		$query = $this->selectquery . " and d.id = " . $iid;
		return parent::_getRow($query);
	}
		
	/**
	 * 
	 * This function will insert a row into the REGISTRATION table.
	 *
	 * @param JLLeague $league
	 * @return boolean
	 */
   	function insert(JLTeamRegistration $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, division_id, season, team_id, name, address, city, state, email, teamname, agegroup, existingteam, phone, cellphone, published, paid, confirmed, tournament, allstarevent, regdate, registeredby, divclass, requestedclass, confnum, tosack, ipaddr) '
			. ' VALUES (0,'
			. '"' . $obj->getDivisionId() . '",' 
			. '"' . $obj->getSeasonId() . '",'
			. '"' . $obj->getTeamId() . '",'
			. '"' . $obj->getName() . '",'			
			. '"' . $obj->getAddress() . '",'						
			. '"' . $obj->getCity() . '",'
			. '"' . $obj->getState() . '",'				
			. '"' . $obj->getEmail() . '",'	
			. '"' . $obj->getTeamName() . '",'
			. '"' . $obj->getAgeGroup() . '",'	
			. '"' . $obj->getExistingTeam() . '",'
			. '"' . $obj->getPhone() . '",'		
			. '"' . $obj->getCellPhone() . '",'																				
			. '"' . $obj->getPublished() . '",'
			. '"' . $obj->isPaid() . '",'				
			. '"' . $obj->isConfirmed(). '",'	
			. '"' . $obj->isPlayingInTournament(). '",'
			. '"' . $obj->isPlayingInAllStarEvent(). '",now(),'
			. '"' . $obj->getRegisteredBy(). '",'
			. '"' . $obj->getDivisionClass(). '",'				
			. '"' . $obj->getRequestedClassification() . '",'					
			. '"' . $obj->getConfirmationNumber(). '",'
			. '"' . $obj->getTosAck() . '",'
			. '"' . $obj->getIpAddress() . '")';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to delete a row from the REGISTRATION table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLTeamRegistration $obj) {
		$query = 'update  ' . $this->getNameQuote( $this->tablename  ) . ' set '
			. ' division_id = "' . $obj->getDivisionId(). '", '
			. ' season = "' . $obj->getSeasonId(). '", '
			. ' team_id = "' . $obj->getTeamId(). '", '
			. ' teamname = "' . $obj->getTeamName(). '", '
			. ' name = "' . $obj->getName(). '", '
			. ' city = "' . $obj->getCity(). '", '
			. ' state = "' . $obj->getState(). '", '
			. ' email = "' . $obj->getEmail(). '", '
			. ' phone = "' . $obj->getPhone(). '", '
			. ' cellphone = "' . $obj->getCellPhone(). '", '
			. ' agegroup = "' . $obj->getAgeGroup(). '", '
			. ' existingteam = "' . $obj->getExistingTeam(). '", '			
			. ' paid = "' . $obj->isPaid() . '", '
			. ' confirmed = "' . $obj->isConfirmed(). '", '
			. ' tournament = "' . $obj->isPlayingInTournament() . '", '
			. ' allstarevent = "' . $obj->isPlayingInAllStarEvent() . '", '
//			. ' confnum = "' . $obj->getConfirmationNumber() . '", '
			. ' divclass = "' . $obj->getDivisionClass() . '", '
			. ' requestedclass = "' . $obj->getRequestedClassification() . '",'					
			. ' tosack = "' . $obj->getTosAck() . '", '
			. ' ipaddr = "' . $obj->getIpAddress() . '", '					
			. ' published = ' . $obj->getPublished()
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }
	    
	/**
	 * This will map the the database row to the REGISTRATION Object
	 *
	 * @param array $row
	 * @return JLTeamRegistration
	 */	
	function loadObject($row) {
		$obj = new JLTeamRegistration();
		$obj->setId($row->id);
		$obj->setDivisionId($row->division_id);
		$obj->setDivisionName($row->divisionname);
		$obj->setSeasonId($row->season);
		$obj->setSeasonTitle($row->seasontitle);
		$obj->setTeamId($row->team_id);
		$obj->setTeamName($row->teamname);
		$obj->setName($row->name);
		$obj->setAddress($row->address);
		$obj->setCity($row->city);
		$obj->setState($row->state);
		$obj->setPhone($row->phone);
		$obj->setEmail($row->email);
		$obj->setCellphone($row->cellphone);
		$obj->setPublished($row->published);
		$obj->setAgeGroup($row->agegroup);
		$obj->setExistingTeam($row->existingteam);
		$obj->setPaid($row->paid);
		$obj->setConfirmationNumber($row->confnum);
		$obj->setPlayingInTournament($row->tournament);
		$obj->setConfirmed($row->confirmed);
		$obj->setRegistrationDate($row->regdate);
		$obj->setRegisteredBy($row->registeredby);
		$obj->setDivisionClass($row->divclass);
		$obj->setRequestedClassification($row->requestedclass);
		$obj->setTosAck($row->tosack);
		$obj->setIpAddress($row->ipaddr);
		return $obj;
	}
	
	function getRecords($start, $stop, $orderby = '', $filter = '') {
		if (strlen($filter)>0) {
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . $filter . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;
			return parent::_getRows($query);						
		} else {
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;			
			return parent::_getRows($query);
		}
 	} 	    
    
	function getTableSize($filter=null) {
		if (strlen($filter)>0) {		
		//	$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t, #__jleague_divmap as dm '
		//		. $filter . ' and t.id = dm.team_id ';
		$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t ' . $filter;
		} else {
			return parent::getTableSize($filter);
		}
	 	$db			=& JLApp::getDBO();
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return sizeof($rows); 
	} 	
	
	/**
	 * This function will produce an array of registered teams for a given season. 
	 *
	 * @param int $seasonid
	 * @return array
	 */
	function getRegisteredTeams($seasonid) {
		$filter = ' where season = ' . $seasonid;
	//	$recs = $this->getRecords(0,9999999999," order by agegroup, divisionname, teamname ", $filter);
		$recs = $this->getRecords(0,9999999999," order by agegroup, teamname ", $filter);
		return $recs;
	}
	
	/**
	 * This function will return a list of UNPAID teams for a given season
	 *
	 * @param int $seasonid
	 * @return array
	 */
	function getUnpaidTeams($seasonid) {
		$filter = ' where paid = 0 and season = ' . $seasonid;
		$recs = $this->getRecords(0,9999999999," order by teamname ", $filter);
		return $recs;
	}

	/**
	 * This is a simple query that will return a boolena to indicate if a team is registered for the
	 * specified season.
	 *
	 * @param int $teamid
	 * @param int $seasonid
	 * @return boolean
	 */
	function isTeamRegistered($teamid, $seasonid) {
		$filter = ' where team_id = ' . $teamid . ' and season = ' . $seasonid;
		$recs = $this->getRecords(0,9999999999," order by agegroup, teamname ", $filter);
		if (sizeof($recs)>0) {
			return true;
		} else {
			return false;
		}
	}
	

}
