<?php

/**
 * @version 		$Id: factory.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Classes
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class JLFactory {

	function getDocument() {
		$document =& JFactory::getDocument();
		return $document;
	}
	
	function getLanguage() {
		$lang		=& JFactory::getLanguage();	
		return $lang;
	}
	
	function getCache($group, $output) {
		$cache = &JFactory::getCache($group, $output);
		return $cache;
	}
	
	function getApplication() {
		$app = &JFactory::getApplication();
		return $app;
	}
	
	function getDatabase() {
		$db			=& JFactory::getDBO();
		return $db;
	}
	
	function getUser($id) {
		$user    = JFactory::getUser($id);
		return $user;		
	}
	
	function &getLeagueService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'leagueservice.class.php');
		$instance = JLLeagueService::getInstance();
		return $instance;
	}
	
	function &getLeagueDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'leaguedao.class.php');
		$instance = JLLeagueDAO::getInstance();
		return $instance;	
	}
	
	function &getPlayerDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'playerdao.class.php');
		$instance = & JLPlayerDAO::getInstance();
		return $instance;	
	}
		
	function &getContactsDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'contactdao.class.php');
		$instance = JLContactsDAO::getInstance();
		return $instance;	
	}	
	function &getDivisionDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'divisiondao.class.php');
		$instance = JLDivisionDAO::getInstance();
		return $instance;
	}	

	function &getDivisionService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
		$instance = &JLDivisionService::getInstance();
		return $instance;		
	}	
	function &getSeasonService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		$instance = &JLSeasonService::getInstance();
		return $instance;		
	}

	function &getRegistrationService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'registrationservice.class.php');
		$instance = &JLRegistrationService::getInstance();
		return $instance;		
	}	
	function &getRegistrationDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'registrationdao.class.php');
		$instance = JLRegistrationDAO::getInstance();
		return $instance;	
	}
		
	function &getSeasonDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'seasondao.class.php');
		$instance = &JLSeasonDAO::getInstance();
		return $instance;		
	}	
	
	
	function &createLeague() {
		include_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'league.class.php');
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLLeague();
			$instance->setId(0);
		}
		return $instance;
	}
	
	function &createSeason() {
		include_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'season.class.php');
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSeason();
			$instance->setId(0);
		}
		return $instance;
	}

	function createDivision() {
		include_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'division.class.php');
		$instance = new JLDivision();
		$instance->setId(0);
		return $instance;
	}


	function &getTeamService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		$instance = &JLTeamService::getInstance();
		return $instance;		
	}	
	function &getTeamDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'teamdao.class.php');
		$instance = &JLTeamDAO::getInstance();
		return $instance;			
	}		
	
	function createTeam() {
		include_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'team.class.php');
		$instance = new JLTeam();
		$instance->setId(0);
		return $instance;
	}
		
	function &getStandingsService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
		$instance = &JLStandingsService::getInstance();
		return $instance;		
	}	
	function &getStandingsDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'standingsdao.class.php');
		$instance = &JLStandingsDAO::getInstance();
		return $instance;			
	}


	function &getGamesService() {
		include_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		$instance = JLGamesService::getInstance();
		return $instance;
	}
	
	function &getGamesDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'gamesdao.class.php');
		$instance = JLGamesDAO::getInstance();
		return $instance;	
	}	
	
	
	function createGame() {
		include_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'game.class.php');
		$instance = new JLGame();
		$instance->setId(0);
		$instance->setAwayLeagueFlag("Y");
		$instance->setHomeLeagueFlag("Y");
		return $instance;
	}	
	
		
	function &getRosterDao() {
		include_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'rosterdao.class.php');
		$instance = &JLRostersDAO::getInstance();
		return $instance;		
	}		
}
?>