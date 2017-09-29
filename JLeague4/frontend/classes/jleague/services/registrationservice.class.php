<?php
/**
 * @version		$Id: registrationservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */



require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');

class JLRegistrationService  extends JLBaseService  {

	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * Enter description here...
	 *
	 * @return JLRegistrationService
	 */
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLRegistrationService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'registrationdao.class.php');
		return JLRegistrationDAO::getInstance();
	}
	
	function savePendingRegistration(JLTeamRegistration $obj) {
		// if team is an existing team, then their registration is confirmed.  Confirmed registration does not mean 
		// they have a place in the league.
		if ($obj->getExistingTeam()) {
			$obj->setConfirmed(true);
		}
		parent::save($obj);		
	}
	
	function save(JLTeamRegistration $obj) {
		// Update the team information.
		if ($obj->isPaid() || $obj->getPublished()) {
			if ($obj->getTeamId() == 0 ) {
				require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
				require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'team.class.php');
				$svc = & JLTeamService::getInstance();
				$team = new JLTeam();
				$team->setName($obj->getTeamName());
				$team->setCoachName($obj->getName());
				$team->setCoachEmail($obj->getEmail());
				$team->setCoachPhone($obj->getPhone());
				$team->setState($obj->getState());
				$team->setCity($obj->getCity());
				
				$rc = $svc->save($team);
				if (!rc) {
					throw new Exception("ERROR:  Unable to create new team");
				}
				$obj->setTeamId($team->getId());
			} else {
				// Update existing team record
				$svc = & JLTeamService::getInstance();
				$team = $svc->getRow($obj->getTeamId());
				$team->setName($obj->getTeamName());
				$team->setCoachName($obj->getName());
				$team->setCoachEmail($obj->getEmail());
				$team->setCoachPhone($obj->getPhone());
				$team->setState($obj->getState());
				$team->setCity($obj->getCity());
				$rc = $svc->save($team);
				if (!rc) {
					throw new Exception("ERROR:  Unable to create new team");
				}
			}
		}
		// Save the REGISTRATION RECORD
		// If the team has paid, then set PUBLISHED to true.
		if ($obj->isPaid()) {
			$obj->setPublished(true);
		}
		return parent::save($obj);
	}
	
	/**
	 * This function should be used to determine if registration is even open.
	 *
	 * @return unknown
	 */
	function isRegistrationOpen() {
		$config = JLApplication::getConfig();
		$ssvc = JLFactory::getSeasonService();
		
		if (!$config->getProperty('registration_open')) {
			return false;
		}
		$seasons = $ssvc->getSeasonsOpenForRegistration();
		if (count($seasons)<= 0) {
			return false;
		} else {
			return true;		
		}
		return false;		
	}
	
	
	/**
	 * This function will return a JLSeason object for the season that registration
	 * is eligible for.
	 *
	 * @return JLSeason
	 */
	function getRegistrationSeason() {
		$ssvc = JLFactory::getSeasonService();
		$seasons = $ssvc->getSeasonsOpenForRegistration();
		return $seasons[0];		
	}
	
	function registerTeam(JLTeamRegistration $reg) {
		return $this->save($reg);
	}
	
	function getUnregisteredTeams($filter_season) {
		$filter = ' where season <> ' . $filter_season;
		$service = JLFactory::getTeamService();
		$teams = $service->getRecords(0,9999999999, 'ORDER BY name', $filter);
		return $teams;
	}

	function getRegisteredTeams($seasonid) {
		$dao = $this->getDao();
		return $dao->getRegisteredTeams($seasonid);	
	}

	function update(JLTeamRegistration $reg) {
		$dao = $this->getDao();
		return $dao->update($reg);
	}
	
	function isTeamRegistered($teamid,$seasonid) {
		$dao = $this->getDao();
		return $dao->isTeamRegistered($teamid,$seasonid);	
	}
	
	function getUnpaidRegistrations($seasonid) {
		require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'registrationdao.class.php');
		$dao = &JLRegistrationDAO::getInstance();
		return $dao->getUnpaidTeams($seasonid);
	}
}

?>