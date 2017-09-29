<?php

/**
 * @version			$Id: address.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage		Conrollers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL
 */

defined( '_FSTLIB' ) or die( 'Restricted access' );

require_once(FST_LIB_CORE . 'controller.php');

class mStandings extends mBaseController {
	

	/**
	 * viewStandings - this task will generate a display of a given seasons standings.  This query will require a
	 * SEASON ID to be passed onthe request object.
	 * 
	 */
	function viewStandings() {
		//$app = self::getApp();
				
		/* Obtain the request and required parameters */
		//$req = &fsRequest::getInstance();
		$seasonid = self::getVariable("seasonid");
		$divid = self::getVariable("divid");
		
		self::writeDebug("Inside viewStandings task - mStandings controller");
	
		$config = $this->config;
		$leagueid = $config->getLeagueId();
		
		// Find most recent season.  If the seasonid is NOT passed, then retrieve the standings for the most recent season
		$seasonsvc = &JLSeasonService::getInstance();
		if ($seasonid != null) {
			$season = $seasonsvc->getRow($seasonid);
		} else {
			$season = $seasonsvc->getMostRecentSeason();
		}
		if (!is_object($season)) {
			echo "No Season found";
			return;
		}
				
		self::writeDebug("Generating standings for League Id = " . $leagueid . " Season Id = " . $season->getId() . " Status=" . $season->getStatus(),true);
		
		//$ssvc = & JLSecurityService::getInstance();
				
 		$filter = mHtmlHelper::getSeasonSelectList("seasonid", $season->getId(), null,"getStandings("  . $leagueid . ", this.value);" );
		
		$view = new mStandingsView(APP_TEMPLATES_PATH);
	
		$wrapper = new fsTemplate("standings");
 		$wrapper->setObject('season',$season);
 		$wrapper->setObject('filter',$filter);
 		$publish = $season->getPublishStandings();
 		
 		if (($season->getStatus() != "P" && $publish) or (self::isAdmin())) {
 		//if (($season->getStatus() != "P" && $publish) ) {
 			//$publish = $season->getPublishStandings();
 			//$svc = & JLSecurityService::getInstance();
 			if (self::isAdmin()) {
 				$publish = true;
 			}
			// Get standings
// 			$standingssvc = &JLStandingsService::getInstance();
// 			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);
			$standingssvc = &JLStandingsService::getInstance();
			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);
			
			self::writeDebug("Number of Standings records returned = " . sizeof($rows),true);

			$tableview = new fsTemplate("standingstable");
			
			$tableview->setObject('standings',$rows);
			$tableview->setObject('season',$season);
			$tableview->setObject('publishstandings',$publish);
			$dao = &JLDivisionDAO::getInstance();
			$dsvc = &JLDivisionService::getInstance();
			$divisions = $dsvc->getDivisionsForSeason($season->getId());
			//print_r($divisions);
			$tableview->setObject('divdao',$dao);
			$tableview->setObject('divisionlinks',$divisionlinks);
 			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$wrapper->addTemplate($tableview);			
		} else {
			$tableview = new fsTemplate("lookwhoscoming");
			$tableview->setAlias("standingstable");
			$regsvc = &JLRegistrationService::getInstance();
			$registrations = $regsvc->getRegisteredTeams($season->getId());
			
			self::writeDebug("# of registrations found = " . count($registrations),true);
			
			$tableview->setObject('registrations',$registrations);
			$tableview->setObject('season',$season);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$wrapper->addTemplate($tableview);
		}
 		$view->addTemplate($wrapper);
		$view->render();
	}
	
	function viewTournamentStandings() {
		//$app = self::getApp();
		
		/* Obtain the request and required parameters */
		//$req = &fsRequest::getInstance();
		$seasonid = self::getVariable("seasonid");
		$divid = self::getVariable("divid");
		
		self::writeDebug("Inside viewStandings task - mStandings controller");
		echo "inside viewTOurnamentStandings";
		$config = $this->config;
		$leagueid = $config->getLeagueId();
		
		// Find most recent season.  If the seasonid is NOT passed, then retrieve the standings for the most recent season
		$seasonsvc = &JLSeasonService::getInstance();
		if ($seasonid != null) {
			$season = $seasonsvc->getRow($seasonid);
		} else {
			$season = $seasonsvc->getMostRecentSeason();
		}
		if (!is_object($season)) {
			echo "No Season found";
			return;
		}
		
		self::writeDebug("Generating standings for League Id = " . $leagueid . " Season Id = " . $season->getId() . " Status=" . $season->getStatus(),true);
		
		//$ssvc = & JLSecurityService::getInstance();
		
		$filter = mHtmlHelper::getSeasonSelectList("seasonid", $season->getId(), null,"getStandings("  . $leagueid . ", this.value);" );
		
		$view = new mStandingsView(APP_TEMPLATES_PATH);
		
		$wrapper = new fsTemplate("standings");
		$wrapper->setObject('season',$season);
		$wrapper->setObject('filter',$filter);
		$publish = $season->getPublishStandings();
			
		if (($season->getStatus() != "P" && $publish) or (self::isAdmin())) {
			//$publish = $season->getPublishStandings();
			//$svc = & JLSecurityService::getInstance();
			if (self::isAdmin()) {
				$publish = true;
			}
			// Get standings
			// 			$standingssvc = &JLStandingsService::getInstance();
			// 			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);
			$standingssvc = &JLStandingsService::getInstance();
			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);
				
			self::writeDebug("Number of Standings records returned = " . sizeof($rows),true);
		
			$tableview = new fsTemplate("standingstable");
			
			echo "Generating standings for League Id = " . $leagueid . " Season Id = " . $season->getId() . " Status=" . $season->getStatus();
				
			echo "generating tournament standings";

			$rows = array();
			$engine = new JLStandingsEngine();

			
			$rows = $engine->generateTournamentStandings($season->getId(),$divid);
			
			print_r($rows);
			exit;
						
			$tableview->setObject('standings',$rows);
			$tableview->setObject('season',$season);
			$tableview->setObject('publishstandings',$publish);
			$dao = &JLDivisionDAO::getInstance();
			$dsvc = &JLDivisionService::getInstance();
			$divisions = $dsvc->getDivisionsForSeason($season->getId());
			$tableview->setObject('divdao',$dao);
			$tableview->setObject('divisionlinks',$divisionlinks);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$wrapper->addTemplate($tableview);
		} 
		$view->addTemplate($wrapper);
		$view->render();
	}
	
	
	/**
	 * ajaxGetStandings is a task that is called by an JQuery AJAX call.  It essentially is the same as the viewStandings
	 * task but omits rendering of the standings "header" page that includes the filter.
	 */
	function ajaxGetStandings()
	{
		
		//$app = &mFactory::getApp();
		
		$leagueid =  self::getVariable("leagueid");
		$seasonid =  self::getVariable("seasonid");
		$divid =  self::getVariable("divid");
	
		// Find most recent season
		$seasonsvc = JLSeasonService::getInstance();
		$season = $seasonsvc->getRow($seasonid);
		if (!is_object($season)) {
			echo "ERROR:  NO SEASON FOUND";
			return;
		}

		$view = new mStandingsView(APP_TEMPLATES_PATH);
		
		if ($season->getStatus() != "P") {
			$publish = $season->getPublishStandings();
		 	$svc = & JLSecurityService::getInstance();
 			if ($svc->isAdmin()) {
 				$publish = true;
 			}
			
			// Get standings
			$standingssvc = &JLStandingsService::getInstance();
			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);
			$tableview = new fsTemplate("standingstable");
			$tableview->setObject('publishstandings',$publish);
			$tableview->setObject('standings',$rows);
			$tableview->setObject('season',$season);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$dao = &JLDivisionDAO::getInstance();
			$dsvc = &JLDivisionService::getInstance();
			$divisions = $dsvc->getDivisionsForSeason($season->getId());
			$tableview->setObject('divdao',$dao);
			$tableview->setObject('divisionlinks',$divisionlinks);
			$view->addTemplate($tableview);
		} else {
			$tableview = new fsTemplate("lookwhoscoming");
			$regsvc = &JLRegistrationService::getInstance();
			$registrations = $regsvc->getRegisteredTeams($season->getId());

			self::writeDebug("# of registrations found = " . count($registrations),true);
			
			$tableview->setObject('registrations',$registrations);
			$tableview->setObject('season',$season);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$view->addTemplate($tableview);
		}
		$view->render();
	}	

	/**
	 * printStandings 
	 */
	function printStandings() {
		
	}
	
}  