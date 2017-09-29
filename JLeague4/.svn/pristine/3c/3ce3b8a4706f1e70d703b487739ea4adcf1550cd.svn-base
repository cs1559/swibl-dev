<?php
/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Controllers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

/**
 * Division Controller
 */
class JLeagueControllerAjax extends JLeagueController
{

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * This is an AJAX function that will obtain all of the divisions for a given season.  This typically
	 * would be used on an event for a select list.
	 *
	 * @return JSON
	 */
	function getDivisionListForSeason() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'divisionservice.class.php');
		if (!isset($_REQUEST["seasonid"])) {
			return "ERROR:  Missing SEASON ID value";
		}
		$seasonid = $_REQUEST["seasonid"];
		$service = &JLDivisionService::getInstance();
		$jsonstr = $service->getDivisionsForSeasonJSON($seasonid);
		echo $jsonstr;
	}
	
	function getDivisionCompetingTeams() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'divisionservice.class.php');
		if (!isset($_REQUEST["divid"])) {
			return "ERROR:  Missing DIVISION ID value";
		}
		$divid = $_REQUEST["divid"];
		$service = &JLDivisionService::getInstance();
		$service->getCompetingTeams($divid);
		$jsonstr = $service->getCompetingTeamsJSON($divid);
		echo $jsonstr;
	}
	
	
}