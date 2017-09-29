<?php
/**
 * @version		$Id: ajax.php 310 2011-12-04 12:31:52Z Chris Strieter $
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

jimport( 'joomla.application.component.controller' );

/**
 * AJ AX Controller.  This controller should be used for AJAX calls only.
 */
class JLeagueControllerAjax  extends JLeagueController {

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

	/**
	 * This function will retrieve a list of teams that compete within a specified division.  The
	 * AJAX request should include a request parameter of divid.
	 *
	 * @return JSON
	 */
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

	/**
	 * This AJAX function call will be used to retrieve a game schedule for a team.
	 *
	 */
	function doScheduleGame() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'gameviewhelper.php');			
		$view = new JLTeamProfileView();
		$game = $view->bindRequestToGameObject();
		$teamid = $_REQUEST["teamid"];
		$svc = & JLGamesService::getInstance();
		
		if (!$svc->save($game)) {
			echo "ERROR:  Add Scheduled Game failed";
			return;
		}		
		$csvc = & JLSeasonService::getInstance();
		try {
			$season = $csvc->getActiveSeason();
		} catch (Exception $e) {
			echo JLText::getText("ERROR:  Unable to schedule game with no active season");
			return;
		}
		
		$tservice = & JLTeamService::getInstance();
		$games = $tservice->getAllTeamGames($teamid,$season->getId());
		
		$tmpl = new JLTemplate("scheduletable");
		$tmpl->setObject('games',$games);
		$html = $tmpl->getContent();
		echo $html;
	}


	/**
	 * This function will SAVE a game regardless if it is scheduled or completed.  It will
	 * also return as its AJAX response the html to show the games for the specific team.
	 *
	 */
	function doSaveGame() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'json.class.php');	
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'gameviewhelper.php');
		$view = new JLTeamProfileView();
		$game = $view->bindRequestToGameObject();
		$teamid = $_REQUEST["teamid"];
		$svc = & JLGamesService::getInstance();

		if (!$svc->save($game)) {
			echo "ERROR:  Update Scheduled Game failed";
			return;
		}
				
		$csvc = & JLSeasonService::getInstance();
		$season = $csvc->getActiveSeason();
		
		$tservice = & JLTeamService::getInstance();
		$games = $tservice->getAllTeamGames($teamid,$season->getId());
		
		$tmpl = new JLTemplate("scheduletable");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('teamid',$teamid);
		$html = $tmpl->getContent();
		echo $html;
	}

	function doPostScore() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'json.class.php');	
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'gameviewhelper.php');
		$view = new JLTeamProfileView();
		$game = $view->bindRequestToGameObject();
		$teamid = $_REQUEST["teamid"];
		$svc = & JLGamesService::getInstance();

		if (!$svc->postScore($game)) {
			echo "ERROR:  Update Scheduled Game failed";
			return;
		}
				
		$csvc = & JLSeasonService::getInstance();
		$season = $csvc->getActiveSeason();
		
		$tservice = & JLTeamService::getInstance();
		$games = $tservice->getAllTeamGames($teamid,$season->getId());
		
		$tmpl = new JLTemplate("scheduletable");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('teamid',$teamid);
		$html = $tmpl->getContent();
		echo $html;
	}
	
	function doDeleteGame() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'gameviewhelper.php');
		$view = new JLTeamProfileView();

		// @TODO Add EDIT check to validate that the logged in person can actually delete the game.
		
		$teamid = $_REQUEST["teamid"];
		$gameid = $_REQUEST["gameid"];
		$svc = & JLGamesService::getInstance();

		try {
			$svc->delete($gameid);
		} catch (Exception $e) {
			echo "ERROR:  Delete Scheduled Game failed";
			return;
		}
				
		$csvc = & JLSeasonService::getInstance();
		$season = $csvc->getActiveSeason();
		
		$tservice = & JLTeamService::getInstance();
		$games = $tservice->getAllTeamGames($teamid,$season->getId());
		
		$tmpl = new JLTemplate("scheduletable");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('teamid',$teamid);
		$html = $tmpl->getContent();
		echo $html;
	}
		
	/**
	 * Get a JLGame object in JSON format.
	 *
	 */
	function getGameJSON() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'json.class.php');
		$json = new json;
		$gameid = $_REQUEST["id"];
		$svc = & JLGamesService::getInstance();
		if (!$game = $svc->getGame($gameid)) {
			echo "ERROR:  Add Scheduled Game failed";
			return;
		}		
		echo $json->encode($game);
	}
	
	/**
	 * This ajax function is used to update user preferences.
	 * 
	 */
	function updateuserpreferences() {
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'preferenceservice.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'userpreferences.class.php');	
    	$svc = & JLPreferenceService::getInstance();
    	$ssvc = & JLSecurityService::getInstance();
    	//$prefs = $svc->getUserPreferences();
    	
    	$prefs = new JLUserPreferences();
    	$user = JLApplication::getUser();
    	$uid = $user->id;

    	$prefs->setId($uid);
    	$prefs->setUserName($user->name);
    	$prefs->addProperty("landingpage-type",$_REQUEST["landingpage-type"]);
    	$prefs->addProperty("landingpage-value",$_REQUEST["landingpage-value"]);
    			
    	try {
    		$svc->saveUserPreferences($prefs);
    		echo "Update successful";
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}
	}
	
	function getavailableplayers() {
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'playerservice.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'userpreferences.class.php');	
    	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');

    	$csvc = & JLSeasonService::getInstance();
		$season = $csvc->getActiveSeason();
    	
    	$ssvc = & JLSecurityService::getInstance();
    	//$prefs = $svc->getUserPreferences();

    	$psvc = & JLPlayerService::getInstance();
    	$players = $psvc->getUnassignedPlayers($season->getId());

		$tmpl = new JLTemplate("playerlist");
		$tmpl->setObject('players',$players);
		$html = $tmpl->getContent();
    	
		echo $html;
 
	}
	
	function getTeamRoster() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'roster.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'player.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');

		$ssvc = & JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();
		
		$rsvc = & JLSimpleRosterService::getInstance();
		
		$teamid = $_REQUEST["teamid"];
		//$rosterid = $_REQUEST["rosterid"];
		$roster = $rsvc->getRoster($teamid);
		
		$tmpl = new JLTemplate("currentrostertable");
		$players = $roster->getPlayers();
		$tmpl->setObject('players',$players);
		$tmpl->setObject('seasonid',$season->getId());
		$tmpl->setObject('roster',$roster);
		$tmpl->setObject('teamid',$teamid);		
		$html = $tmpl->getContent();
		echo $html;
	}		
	
	
	/**
	 * This function will be used to save a player.  This function will retrieve the associated
	 * values through the HTTP request object.
	 *
	 * @return unknown
	 */
	function ajaxSavePlayer() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'playerservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS. 'rosterservice.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'player.class.php');
		
		//@todo Security check
		/*
        if (!JLSecurityService::isAuthorizedTask()) {
        	if (isset($_REQUEST["teamid"])) {
        		$teamid = $_REQUEST["teamid"];
	        	JLApplication::redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "NOT AUTHORIZED TO SAVE/CREATE PLAYER " );	
        	} else {
        		JLApplication::redirect( "index.php?option=com_jleague" , "NOT AUTHORIZED TO SAVE/CREATE PLAYER " );
        	}	
        }
        */
		
		$service = & JLPlayerService::getInstance();
		$rsvc = & JLRosterService::getInstance();
		

		$player = new JLPlayer();
		if (isset($_REQUEST["playerid"])) { 
			$player->setId($_REQUEST["playerid"]);
		} else {
			$player->setId(0);
		}
		if (isset($_REQUEST["playerfname"])) {
			$player->setFirstName($_REQUEST["playerfname"]);
		}
		if (isset($_REQUEST["playerlname"])) {
			$player->setLastName($_REQUEST["playerlname"]);
		}
		if (isset($_REQUEST["dateofbirth"])) {
			$player->setDateOfBirth($_REQUEST["dateofbirth"]);
		}
		if (isset($_REQUEST["city"])) {
			$player->setCity($_REQUEST["city"]);
		}
		if (isset($_REQUEST["state"])) {
			$player->setState($_REQUEST["state"]);
		}
		//teamid
		//$addtoroster = false;  
		$addtoroster = true;
		if (isset($_REQUEST["addtoroster"])) {
			if ($_REQUEST["addtoroster"] == "on") {
				$addtoroster = true;
			}
		}
		try {
			
			$service->save($player);
			echo "Player has been saved.  ";
			if ($addtoroster) {
				if (isset($_REQUEST["teamid"]) && isset($_REQUEST["seasonid"])) {
					try {
						$rsvc->addPlayerToRoster($player,$_REQUEST["teamid"],$_REQUEST["seasonid"]);
						echo "Player added to roster.";
					} catch (Exception $e) {
						echo "ERROR:  Error occurred adding player to roster";	
					}
				}
			}
		} catch (Exception $e) {
			echo "Error occurred creating player";	
		}
	}
	
	function ajaxAddPlayerToRoster() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'simplerosterservice.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'player.class.php');
		$rsvc = & JLSimpleRosterService::getInstance();
		$teamid = null;
		$seasonid = null;
		if (isset($_REQUEST["teamid"])) { 
			$teamid = $_REQUEST["teamid"];
		} else {
			echo "ERROR:  Missing TEAM Id";
			return;
		}
		if (isset($_REQUEST["seasonid"])) { 
			$seasonid = $_REQUEST["seasonid"];
		} else {
			echo "ERROR:  Missing SEASON Id";
			return;
		}
		
		$player = new JLPlayer();
		if (isset($_REQUEST["playerfname"])) {
			$player->setFirstName($_REQUEST["playerfname"]);
		}
		if (isset($_REQUEST["playerlname"])) {
			$player->setLastName($_REQUEST["playerlname"]);
		}
		try {
			$rsvc->addPlayerToRoster($player, $teamid, $seasonid);
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/*
	function ajaxAddPlayerToRoster() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'rosterservice.class.php');
		
		//@todo Security check
		$context = array("rosterid" => $_REQUEST["rosterid"]);
	    if (!JLSecurityService::isAuthorizedTask($context)) {
        	echo "NOT AUTHORIZED TO ADD PLAYER TO ROSTER";
        	return;
        }
		
		$rsvc = & JLRosterService::getInstance();
		
		$playerid = null;
		$rosterid = null;
				
		if (isset($_REQUEST["playerid"])) {
			$playerid = $_REQUEST["playerid"];
		} else {
			echo "ERROR:  Unknown Player Id";
			return;
		}
		if (isset($_REQUEST["rosterid"])) {
			$rosterid = $_REQUEST["rosterid"];
		} else {
			echo "ERROR:  Unknown Roster Id";
			return;
		}
		try {
			$rsvc->addPlayerToRosterByIds($rosterid, $playerid);	
		} catch (Exception $e) {
			echo "Error occured adding player to roster";
		}
		
	}
	*/
	
	
	function ajaxRemovePlayerFromRoster() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'simplerosterservice.class.php');
		
		//@TODO: Security Check
//		$context = array("rosterid" => $_REQUEST["rosterid"]);
//	    if (!JLSecurityService::isAuthorizedTask($context)) {
//        	echo "NOT AUTHORIZED TO REMOVE PLAYER FROM ROSTER";
//        	return;
//        }
        		
		$rsvc = & JLSimpleRosterService::getInstance();
		
		$playerid = null;
		$rosterid = null;
				
		if (isset($_REQUEST["playerid"])) {
			$playerid = $_REQUEST["playerid"];
		} else {
			echo "ERROR:  Unknown Player Id";
			return;
		}
		try {
			$rsvc->removePlayerFromRoster($playerid);	
		} catch (Exception $e) {
			echo "Error occured removing player from roster";
		}
		
	}
	
	
	function ajaxListTeams() {

		$seasonid = $_REQUEST["seasonid"];
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'listteams.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');		

        $cache = & JLCache::getInstance();
        try {
        	$content = $cache->get("ajaxListTeams",$seasonid);
        	$html = $content;
        } catch (Exception $e) {       
			$seasonsvc = & JLSeasonService::getInstance();
	        $season = $seasonsvc->getRow($seasonid);
			$svc = & JLTeamService::getInstance();
			$teams = $svc->getTeamsInSeason($seasonid,1);
//			$view = new JLListTeamsView();
			$tableview = new JLTemplate('listteamsresults');
			$tableview->setObject('teams',$teams);
			$tableview->setObject('totalteams',sizeof($teams));
			$tableview->setObject('season',$season);
//			$view->addTemplate($tableview);
//			$view->suppressCommonLibraries();
//			$view->display();
			$html = $tableview->getContent();	
			$cache->store("ajaxListTeams",$seasonid,$html);
        }
		echo $html;
	}
	
}