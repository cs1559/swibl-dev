<?php
/**
 * @version		$Id: players.php 102 2010-03-28 11:45:02Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controllers
 * @copyright 	(C) 2008,2009 Chris Strieter
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 *
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');


class mAdmin  extends mBaseController {

	function __construct() {
		parent::__construct();
	}

	private function securityCheck() {
		$svc = & JLSecurityService::getInstance();
		if (!$svc->isAdmin()) {
			echo JLText::getText('ERROR:  NOT AUTHORIZED');
			return false;
		}
		return true;
	}
	
	
	
	/*
	 * Dashboard Reports/Views
	 * - Summary / stats
	 * - Teams without roster or rosters issues
	 * - Team Game Completion Report
	 * - Teams who played last year but did not register this year
	 * - New Teams playing this season
	 */
	function dashboard() {
		if (!$this->securityCheck()) return;
		
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
		
		$doc = $app->getDocument();
		$doc->setTitle("SWIBL - Administrator Dashboard");
		
		$league = $app->getLeague();
		$season = $app->getCurrentSeason();
		
		$rSvc = &JLSimpleRosterService::getInstance();
		$invalidRosters = $rSvc->getInvalidRostersForSeason($season->getId());
		if (isset($invalidRosters)) {
			$invalidRosterCount = count($invalidRosters);
		} else {
			$invalidRosterCount = 0;
		}
		
		$sSvc = &JLSeasonService::getInstance();
		$divisionTeamCounts = $sSvc->getTotalTeamsByDivisionForSeason($season->getId());
		$view = new fsView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("admin.dashboard");
		$tmpl->setObject("league",$league);
		$tmpl->setObject("season",$season);
		$tmpl->setObject("config", $config);
		$tmpl->setObject("divisionTeamCounts",$divisionTeamCounts);
		$tmpl->setObject("invalidRostersCount",$invalidRosterCount);
		$view->addTemplate($tmpl);
		$view->render();
	}
	
	/*
	function display() {
		if (!$this->securityCheck()) return;
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
		require_once(JLEAGUE_VIEWS_PATH . DS . 'admindashboard.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'leagueservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
		
		$config = &JLConfig::getInstance();
		
		$lsvc = &JLLeagueService::getInstance();
		$league = $lsvc->getRow($config->getLeagueId());
		
		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();
		
		$rsvc = &JLSimpleRosterService::getInstance();
		$totalplayers = $rsvc->getTotalPlayersForSeason($season->getId());
		$totalrosters = $rsvc->getTotalRostersForSeason($season->getId());
		
		$view = new JLAdminDashboardView();
		$view->addScript(JURI::root() . 'components/com_jleague/js/dashboard.js');
		$tmpl = new JLTemplate("admdashboard");
		$contenttmpl = new JLTemplate("admdashboard-summary");
		$contenttmpl->setObject('league',$league);
		$contenttmpl->setObject('season',$season);
		$contenttmpl->setObject('config',JLConfig::getInstance());
		$contenttmpl->setObject('totalplayers',$totalplayers);
		$contenttmpl->setObject('totalrosters',$totalrosters);		
		$tmpl->setObject('dashboardcontent',$contenttmpl->getContent());
		$view->addTemplate($tmpl);
        $view->display();
	}


	
*/
	
	/*
			$viewlist[] =JHTML::_('select.option', "summary", 'Season Summary' );
		$viewlist[] =JHTML::_('select.option', "newteams", 'New Teams' );
		$viewlist[] =JHTML::_('select.option', "notregistered", 'Teams Not Registered' );
		$viewlist[] =JHTML::_('select.option', "rosterreport", 'Roster Report' );
		$viewlist[] =JHTML::_('select.option', "gamecompletion", 'Game Completion Report' );
	*/
	
	
	function updateTournamentAndPaid() {
		if (!$this->securityCheck()) return;
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
		
		$league = $app->getLeague();
		$season = $app->getCurrentSeason();
			
		$svc = &JLTeamService::getInstance();
		$teams = $svc->getStandingsWithRegistrationData($season->getId());
			
		$view = new mTeamView(APP_TEMPLATES_PATH);
		$contenttmpl = new fsTemplate("admin.report.teamstatus");
		$contenttmpl->setObject('teams',$teams);
		$view->addTemplate($contenttmpl);
		$view->render();
		
	}
	
	
	function getSeasonSummary() {
		if (!$this->securityCheck()) return;
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'leagueservice.class.php');
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
		
		$config = &JLConfig::getInstance();

		$lsvc = &JLLeagueService::getInstance();
		$league = $lsvc->getRow($config->getLeagueId());
		
		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();
		
		$rsvc = &JLSimpleRosterService::getInstance();
		$totalplayers = $rsvc->getTotalPlayersForSeason($season->getId());
		$totalrosters = $rsvc->getTotalRostersForSeason($season->getId());
				
		$contenttmpl = new JLTemplate("admdashboard-summary");
		$contenttmpl->setObject('league',$league);
		$contenttmpl->setObject('season',$season);
		$contenttmpl->setObject('totalplayers',$totalplayers);
		$contenttmpl->setObject('totalrosters',$totalrosters);			
		$contenttmpl->setObject('config',JLConfig::getInstance());
		echo $contenttmpl->getContent();
	}
		
	function getUnpaidReport() {
		if (!$this->securityCheck()) return;
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'registrationservice.class.php');
		
		$config = &JLConfig::getInstance();

		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();

		$rsvc = &JLRegistrationService::getInstance();
		$registrations = $rsvc->getUnpaidRegistrations($season->getId());

		$contenttmpl = new JLTemplate("admdashboard-unpaid");
		$contenttmpl->setObject('registrations',$registrations);
		$contenttmpl->setObject('season',$season);
		$contenttmpl->setObject('config',JLConfig::getInstance());
		echo $contenttmpl->getContent();
		
	}
	
	
	function getNewTeamsList() {
		if (!$this->securityCheck()) return;
		echo "getNewTeamsList";
	}
	
	function getNotRegistered() {
		if (!$this->securityCheck()) return;
		echo "getNotRegistered";
	}
	
	function getRosterReport() {
		if (!$this->securityCheck()) return;
		echo "getRosterReport";
	}
	
	function getGameCompletionReport() {
		if (!$this->securityCheck()) return;
		echo "getGameCompletionReport";
	}
	
	function closeSeason() {
		if (!$this->securityCheck()) return;
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
		
		$league = $app->getLeague();
		$season = $app->getCurrentSeason();

		$sSvc = &JLSeasonService::getInstance();

		echo $season;
		exit;
		
		
		try {
		$sSvc->closeSeason($season);
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/*

	*/
	/**
	 * This function will obtain and render the initial table of team announcements
	 */
	function manageBulletins() {
		if (!$this->securityCheck()) return;
		
		$app = &mFactory::getApp();
		$config = $app->getConfig();
		$ssvc = &JLSecurityService::getInstance();
	
		$editor = &JFactory::getEditor();
		
		$req = fsRequest::getInstance();
		$team = new JLTeam();
		$team->setId(0);
// 		$teamid = $req->getValue("teamid");
	
		$bsvc = &JLBulletinsService::getInstance();
		$bulletins = $bsvc->getTeamBulletins(0);
	
		$view = new mTeamView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("admin.bulletins");
		$tmpl->setObject("team", $team);
		$tmpl->setObject("editor",$editor);
		$ttmpl = new fsTemplate("admin.bulletins.table");
		$ttmpl->setAlias("bulletinstable");
		$ttmpl->setObject("bulletins", $bulletins);
		$tmpl->addTemplate($ttmpl);
		$view->addTemplate($tmpl);
		$view->render();
	}
	
	/**
	 * This function will generate a print out of the site configuration settings.
	 */
	function getSiteConfig() {
		$svc = & JLSecurityService::getInstance();
		if ($svc->isAdmin()) {
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			$properties = $config->getProperties();
			$view = new mTeamView(APP_TEMPLATES_PATH);
			$contenttmpl = new fsTemplate("admin.report.config");
			$contenttmpl->setObject('properties',$properties);
			$view->addTemplate($contenttmpl);
			$view->render();
		} else {
			echo JLText::getText('WARNING:  Unauthorized Access');
		}
	}
	
	/**
	 * This function will generate a report of teams that currently do not have an owner defined
	 * to manage the profile.
	 */
	function getNoOwnerReport() {
		$svc = & JLSecurityService::getInstance();
		if ($svc->isAdmin()) {
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			$season = $app->getCurrentSeason();
			
			$doc = $app->getDocument();
			$doc->setTitle("SWIBL - Teams with no Owner Report");
			
			$svc = &JLTeamService::getInstance();
			$teams = $svc->getTeamsWithNoOwner($season->getId());
			$view = new mTeamView(APP_TEMPLATES_PATH);
			$contenttmpl = new fsTemplate("admin.report.noowner");
			$contenttmpl->setObject('teams',$teams);
			$view->addTemplate($contenttmpl);
			$view->render();
		} else {
			echo JLText::getText('WARNING:  Unauthorized Access');
		}
	}
	
}