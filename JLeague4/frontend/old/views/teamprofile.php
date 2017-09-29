<?php
/**
 * @version 		$Id: teamprofile.php 305 2011-11-25 03:21:58Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'team.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'division.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'season.class.php');

class JLTeamProfileView extends JLFrontendBaseView {

	private $team = null;
	
	function __construct(JLTeam $team = null) {
		parent::__construct();
		if ($team != null) {
			$this->team = $team;
		}
	}

	function display() {
		parent::display();
	}
	function getNewSubmenu(JLTeam $team=null) {
		$config = JLApplication::getConfig();
		if ($team == null) {
			return "";
		}
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
		$submenu = '';
		
		$svc = JLSecurityService::getInstance();
		if ($svc->canEditTeamProfile($team)) {
			$smtmpl = new JLTemplate("submenu2");			
			$functions = "Menu Options: " . JLHtml::getTeamProfileMenu("profilemenu","",$team->getId(), $team->getSlug());
			$smtmpl->setObject('functionlist', $functions);			
			$submenu = $smtmpl->getContent();
		}
		return $submenu;
	}	
	function getSubmenu(JLTeam $team=null) {
		$config = JLApplication::getConfig();
		if ($team == null) {
			return "";
		}
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
		$submenu = '';
		
		$svc = JLSecurityService::getInstance();
		if ($svc->canEditTeamProfile($team)) {
			$smtmpl = new JLTemplate("submenu");
			$smtmpl->setObject('profilehomelink', JRoute::_('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' . $team->getId()));			
			$smtmpl->setObject('editteamprofilelink', JRoute::_('index.php?option=com_jleague&controller=teams&task=editTeamProfile&teamid=' . $team->getId()));
			$smtmpl->setObject('uploadteamlogolink', JRoute::_('index.php?option=com_jleague&controller=teams&task=uploadLogo&teamid=' . $team->getId()));
			$smtmpl->setObject('managecontactslink', JRoute::_('index.php?option=com_jleague&controller=teams&task=manageContacts&teamid=' . $team->getId()));
			$smtmpl->setObject('managerosterslink', JRoute::_('index.php?option=com_jleague&controller=teams&task=manageRoster&teamid=' . $team->getId()));
			$smtmpl->setObject('fieldinfolink',JRoute::_('index.php?option=com_jleague&controller=teams&task=updateFieldInfo&teamid=' . $team->getId()));
			$smtmpl->setObject('manageschedulelink', JRoute::_('index.php?option=com_jleague&controller=teams&task=manageschedule&teamid=' . $team->getId()));
//			$smtmpl->setObject('editgamescores', JRoute::_('index.php?option=com_jleague&controller=teams&task=editgames&teamid=' . $team->getId()));
			$submenu = $smtmpl->getContent();
		}
		return $submenu;
	}
	
	/**
	 * The getTitle function will override the base class method.  The reason for this is to
	 * enable customization of the document title based on the team name.
	 *
	 * @return unknown
	 */
	function getTitle() {
		$team = $this->team;
		if ($team != null) {
			return $team->getName();
		}
		return 'Team Profile';
	}
	
	function getPrintRosterUrl($teamid,$season) {
	 	$link = JRoute::_('index.php?option=com_jleague&controller=rosters&task=printroster&teamid=' . $teamid . '&season='.$season);
	 	return $link;
	}
	
	function isCommunityGroupAvailable() {
		if (isset($this->team)) {
			if ($this->team->getCommunityItem()) {
				return "YES";
			} else {
				return "Not Available";
			}
		}
	}
	
	function getHomeField() {
		$default_value = JLText::getText('JL_UNAVAILABLE');
		if (isset($this->team)) {
			$team = $this->team;
			if ($team != null) {
				return $team->getName();
			}
		}
		return $default_value;
	}
	

	/**
	 * This function will bind an EDIT request from this view to the TEAM object.
	 *
	 * @param JLTeam $team
	 * @return not applicable 
	 */
	function bindRequest(JLTeam &$team) {
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		$team->setId(JLUtil::getRequestParam('teamid','0'));
		if (isset($_REQUEST['teamname'])) {
			$team->setName(JLUtil::getRequestParam('teamname',''));
		}
		if (isset($_REQUEST['website'])) {
			$team->setWebsite(JLUtil::getRequestParam('website',''));
		}
		if (isset($_REQUEST['city'])) {
			$team->setCity(JLUtil::getRequestParam('city',''));
		}
		if (isset($_REQUEST['state'])) {
			$team->setState(JLUtil::getRequestParam('state',''));
		}
		if (isset($_REQUEST['ownerid'])) {
			$team->setOwnerId(JLUtil::getRequestParam('ownerid',''));
		}		
		if (isset($_REQUEST['fieldname'])) {
			$team->setHomeField(JLUtil::getRequestParam('fieldname'));
		}
		if (isset($_REQUEST['fielddirections'])) {
			$team->setFieldDirections(JLUtil::getRequestParam('fielddirections'));
		}
		if (isset($_REQUEST['fieldlatitude'])) {
			$team->setFieldLatitude(JLUtil::getRequestParam('fieldlatitude'));
		}
		if (isset($_REQUEST['fieldlongitude'])) {
			$team->setFieldLongitude(JLUtil::getRequestParam('fieldlongitude'));
		}
		if (isset($_REQUEST['fieldaddress'])) {
			$team->setFieldAddress(JLUtil::getRequestParam('fieldaddress'));
		}
		if (isset($_REQUEST['coachname'])) {
			$team->setCoachName(JLUtil::getRequestParam('coachname'));
		}		
		if (isset($_REQUEST['coachemail'])) {
			$team->setCoachEmail(JLUtil::getRequestParam('coachemail'));
		}		
		if (isset($_REQUEST['coachphone'])) {
			$team->setCoachPhone(JLUtil::getRequestParam('coachphone'));
		}		
		

		foreach ($team->getCustomFields() as $field) {
			if ($field instanceof JLField) {
				if (isset($_REQUEST[$field->getKeycode()])) {
					$field->setValue($_REQUEST[$field->getKeycode()]);
					$team->setField($field);
				}
			}
		}
	}
	
	function bindRequestToGameObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'game.class.php');
		$game = new JLGame();
		if (isset($_REQUEST["id"])) {
			$game->setId($_REQUEST["id"]);
		} else {
			$game->setId(0);
		}
		
		if (isset($_REQUEST["division_id"])) {
			$game->setDivisionId($_REQUEST["division_id"]);
		} else {
			throw new Exception(JLText::getText('JL_UNKNOWN_DIVISION_ID'));
		}
		if (isset($_REQUEST["season_id"])) {
			$game->setSeason($_REQUEST["season_id"]);
		} else {
			throw new Exception(JLText::getText('JL_UNKNOWN_SEASON_ID'));
		}		

		if (isset($_REQUEST["gamedate"])) {
			$game->setGameDate($_REQUEST["gamedate"]);
		} else {
			throw new Exception(JLText::getText('JL_MISSING_GAMEDATE'));
		}
				
		if (isset($_REQUEST["conference_game"])) {
			$game->setConferenceGame($_REQUEST["conference_game"]);
		} else {
			throw new Exception(JLText::getText('JL_MISSING_CONFGAME_INDICATOR'));
		}		
		
    	if (isset($_REQUEST['cb_league_hometeam'])) {
    		if ($_REQUEST['cb_league_hometeam']  == "on") {
    			$game->setHomeLeagueFlag("Y");
    		} else {
    			$game->setHomeLeagueFlag("N");
    		}
    	} else {
    		$game->setHomeLeagueFlag("N");
    	}
    	if (isset($_REQUEST['cb_league_awayteam'])) {
    		if ($_REQUEST['cb_league_awayteam']  == "on") {
    			$game->setAwayLeagueFlag("Y");
    		} else {
    			$game->setAwayLeagueFlag("N");
    		}
    	} else {
    		$game->setAwayLeagueFlag("N");
    	}  

    	if (isset($_REQUEST["hometeam_id"])) {
			$game->setHometeamId($_REQUEST["hometeam_id"]);
		} 
    	if (isset($_REQUEST["hometeam_name"])) {
			$game->setHometeam($_REQUEST["hometeam_name"]);
		} 		
    	if (isset($_REQUEST["awayteam_id"])) {
			$game->setAwayteamId($_REQUEST["awayteam_id"]);
		} 
    	if (isset($_REQUEST["awayteam_name"])) {
			$game->setAwayteam($_REQUEST["awayteam_name"]);
		} 			
		
		if (isset($_REQUEST["hometeam_score"])) {
			$game->setHometeamScore($_REQUEST["hometeam_score"]);
		} else {
			$game->setHometeamScore(0);
		}
		
		if (isset($_REQUEST["awayteam_score"])) {
			$game->setAwayteamScore($_REQUEST["awayteam_score"]);
		} else {
			$game->setAwayteamScore(0);
		}
		
		if (isset($_REQUEST["location"])) {
			$game->setLocation($_REQUEST["location"]);
		} 		
		if (isset($_REQUEST["highlights"])) {
			$game->setHighlights($_REQUEST["highlights"]);
		} 
		if (isset($_REQUEST["gamestatus"])) {
			$game->setGameStatus($_REQUEST["gamestatus"]);
		}
		if (isset($_REQUEST["gametime"])) {
			$game->setGameTime($_REQUEST["gametime"]);
		} 						
		return $game;
	}
	
	function getWebsiteLink() {
		$team = $this->team;	
		$website = $team->getWebsite();
		if (strlen($website)==0) {
			return "Unavailable";
		}
		if (substr($website,0,7) == "http://") {
			return "<a href=\"" . $website . "\">Click Here</a>";	
		} else {
			return "<a href=\"http://" . $website . "\">Click Here</a>";	
//			return "http://" . $website;
		}
	}
	
	function getGameNotificationLink() {
		$svc = &JLSecurityService::getInstance();
		$cfg = &JLConfig::getInstance();
		$notify_enabled = $cfg->getPropertyValue('game_notifactions');
		if ($svc->isLoggedIn() && $notify_enabled) {
			//href="http://localhost/j15/administrator/components/com_jleague/assets/jquery-theme/smoothness/ui.tabs.css"
			return "<a href='javascript:void(0);' onClick='subscribeGameNotification();'><img id='game-notification-signup-image' src='" . JLEAGUE_ASSETS_URL . "/images/subscribe-blue.gif'/></a>";
		} else {
			return "";	
		}
	}
	
	function getOpponent(JLTeam $context, JLGame $game) {
		$teamid = $context->getId();
		if ($game->getAwayteamId() == $teamid) {
			return "@" . $game->getHometeam();	
		} else {
			return $game->getAwayteam();
		}
	}
	
}

?>