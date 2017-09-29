<?php
/**
 * @version		$Id: leagueservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


class JLBulletinsService extends mBaseService {

	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of the JLGameService service object.
	 *
	 * @return JLLeagueService
	 */	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLBulletinsService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = JLBulletinsDAO::getInstance();
		return $dao;
	}
	
	function getTeamBulletins($teamid) {
		if (!is_numeric($teamid)) {
			throw new  Exception("TEAM ID is not numeric");
		}
		$dao = &JLBulletinsDAO::getInstance();
		try {
			$bulletins = $dao->getTeamBulletins($teamid);
		} catch (Exception $e) {
			throw $e;
		}
		return $bulletins;
	}	
	
	function getLeagueBulletins($days = 180, $rows = 200) {
		$dao = &JLBulletinsDAO::getInstance();
		try {
			$bulletins = $dao->getLeagueBulletinBoardItems($days,$rows);
		} catch (Exception $e) {
			throw $e;
		}
		return $bulletins;
	}

	function getBulletinsByCategory($catid = null) {
		if (!is_numeric($catid)) {
			throw new  Exception("Bulletin Category is not numeric");
		}
		$dao = &JLBulletinsDAO::getInstance();
		try {
			$bulletins = $dao->getBulletinItemsByCategory($catid);
		} catch (Exception $e) {
			throw $e;
		}
		return $bulletins;
	}
	
	function getSponsorBulletins($sponsorid) {
		if (!is_numeric($sponsorid)) {
			throw new  Exception("SPONSOR ID is not numeric");
		}
		$dao = &JLBulletinsDAO::getInstance();
		try {
			$bulletins = $dao->getSponsorBulletins($sponsorid);
		} catch (Exception $e) {
			throw $e;
		}
		return $bulletins;
	}		
	
	function promoteBulletin($bulletinid, $teamid) {
		if (!is_numeric($bulletinid)) {
			throw new  Exception("BULLETIN ID is not numeric");
		}	
		$security = &JLSecurityService::getInstance();
		if (!$security->canEditTeamProfileByTeamId($teamid)) {
			echo "AUTEHTNCATION ERROR:  UNABLE TO DELETE TEAM CONTACT - NOT AUTHORIZED";
			return;
		}
		$dao = &JLBulletinsDAO::getInstance();
		try {
			$dao->promote($bulletinid);
		} catch (Exception $e) {
			throw $e;
		}
		return;
	}
	
}

?>