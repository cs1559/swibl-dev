<?php
/**
 * @version		$Id: rosterservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */



require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_CLASSES_PATH . DS . 'dao' . DS . 'rosterdao.class.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');

class JLRosterService  extends JLBaseService  {

	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLRosterService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLFactory::getRosterDao();
		return $dao;
	}
	
	function createRoster($teamid,$season=null) {
		require_once(JLEAGUE_CLASSES_PATH . DS . 'objects' . DS . 'roster.class.php');
		if ($season == null) {
			try {
				$ssvc = &JLSeasonService::getInstance();
				$seasonobj = $ssvc->getActiveSeason();
				$season = $seasonobj->getId();
			} catch (Exception $e) {
				throw new Exception(JLText::getText("Cannot create a roster when there is no active season"));
			}
		}
		$roster = new JLRoster();
		$roster->setId(0);
		$roster->setSeason($season);
		$roster->setTeamId($teamid);
		return $roster;
//		$dao = $this->getDao();
//		try {
//			if (is_object($row)) {
//				return $dao->update($obj);
//			} else {
//				return $dao->insert($obj);
//			}
//		} catch (Exception $e) {
//			throw $e;
//		}
	}
	
	/**
	 * This function will return the team roster for a specific season.
	 *
	 * @param int $teamid
	 * @return array
	 */
	public function getRoster($teamid, $season = null) {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'rosterservice.class.php');
		
		$ssvc = &JLSeasonService::getInstance();
		if ($season == null) { 
			try {
				$seasonobj = $ssvc->getMostRecentSeason();
				$season = $seasonobj->getId();
			} catch (Exception $e) {
				throw $e;
			}
		}
		$dao = $this->getDao(); 

		try {
			$roster = $dao->getTeamRoster($teamid, $season);

			// automatically create a roster
			if ($roster->getId() == 0) {
				$rc = $dao->createRoster($roster);
				$roster = $dao->getTeamRoster($teamid, $season);
			}
		} catch (Exception $e) {
			throw $e;
		}
		return $roster;
		
	}
		
	function addPlayerToRoster(JLPlayer $player,$teamid,$seasonid) {
		$dao = $this->getDao();
		try {
			$dao->addPlayerToRoster($player,$teamid,$seasonid);
		} catch (Exception $e) {
			throw $e;
		}
	}
	function addPlayerToRosterByIds($rosterid, $playerid) {
		$dao = $this->getDao();
		try {
			$dao->addPlayerToRosterByIds($rosterid,$playerid);
		} catch (Exception $e) {
			throw $e;
		}
	}
	function removePlayerFromRoster($rosterid,$playerid) {
		$dao = $this->getDao();
		try {
			$dao->removePlayerFromRoster($rosterid,$playerid);
		} catch (Exception $e) {
			throw $e;
		}	
	}
	
	function getTotalPlayersForSeason($seasonid) {
		$dao = $this->getDao();
		return $dao->getTotalPlayersForSeason($seasonid);
	}

}

?>