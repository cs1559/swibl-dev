<?php
/**
 * @version		$Id: teams.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controllers
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');
 
class JLeagueControllerTeams extends JLeagueController
{
	
	function display()
    {
        parent::display();
    }
    
    function __construct()
    {
    	parent::__construct();
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
    } 
	
    function viewTeamProfile()
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_PLUGIN_PATH . DS . 'plgstandingsmodule.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'teamprofileviewhelper.php');  
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
		//require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'gameobserver.class.php');
						
		$keyid = JLUtil::getRequestParam('teamid');
        if (!is_numeric($keyid)) {
        	JError::raiseError( 500, "ID is not numeric (teams.php::viewTeamProfile)");
        }
		
        $svc = &JLTeamService::getInstance();
        
//        $dispatcher = JLApplication::getEventDispatcher();
//        $dispatcher->attach(new JLGameObserver());
        
        $tview = $svc->getTeamView($keyid);
       	$view = $this->buildTeamProfileView($tview);
       	
       	$config = $this->getConfig();
       	if ($config->getPropertyValue("game_notifications")) {
	       	$ptmpl = new JLTemplate("subscribe2notifications");
    	   	$view->addTemplate($ptmpl);
       	}
       	//$dispatcher->trigger("onGameSave");
       	
       	$view->display();
       	return;
//        print_r($tview);
        exit;
        
        $cache = & JLCache::getInstance();
        try {
			$view = $cache->get("viewTeamProfile",$keyid);
		} catch (Exception $e) {
	        	$view = $this->buildTeamProfileView($keyid);
	        	$cache->store("viewTeamProfile",$keyid,$view);
		}
		$view->display();
    }

    
    
    private function buildTeamProfileView(JLTeamView $teamview)
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_PLUGIN_PATH . DS . 'plgstandingsmodule.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'teamprofileviewhelper.php');  
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
				
		$row = $teamview->getTeam();
		
		$view = new JLTeamProfileView($row);
        $view->addPathway(JLText::getText('JL_PW_LEAGUE_STANDINGS'),'index.php?option=com_jleague&controller=standings&task=displayStandings&Itemid=181');		
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'));
		$view->addPathway(JLText::getText($row->getName()));
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.tabs.js');
		$view->addScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');		
		
		// Add submenu to the profile 
		$submenu = $view->getSubmenu($row);
		$submenu2 = $view->getNewSubmenu($row);

		$context = array("team" => $row);
		$standings = JLStandingsModulePlugin::exec($context);
		
		$ptmpl = new JLTemplate("teamprofile-twocol");
		$ptmpl->setObject('team',$row);
		$ptmpl->setObject('mostrecentseason',$row->getSeason());
		$ptmpl->setObject('mostrecentdivision',$row->getDivision());
		$ptmpl->setObject('yearsinleague',$teamview->getYearsInLeague());
		$ptmpl->setObject('submenu',$submenu);
		$ptmpl->setObject('submenu2',$submenu2);
		$ptmpl->setObject('standings',$standings);
		
		$viewhelper = new JLTeamProfileViewHelper();
		
		// Retrieve the Team Contacts
		$contacts = $teamview->getTeamContacts();
		$ctmpl = new JLTemplate("teamprofile.contacts");
		$ctmpl->setAlias("teamcontacts");
		$ctmpl->setObject('contacts',$contacts);
		$ctmpl->setObject('helper',$viewhelper);
		$ctmpl->setObject('showheader',false);
		$ptmpl->addTemplate($ctmpl);
		
		// Retrieve any venues/fields for a team
		$venues = $teamview->getVenues();
		$fieldinfo = new JLTemplate("teamprofile.fields");
		$fieldinfo->setAlias("fieldinformation");
		$fieldinfo->setObject('venues',$venues);
		$fieldinfo->setObject('showheader',false);
		$ptmpl->addTemplate($fieldinfo);
		
		// Retrieve the Record hisotry
		$rhtmpl = new JLTemplate("recordhistory");
		$rhtmpl->setAlias("recordhistoryhtml");
		$rhtmpl->setObject('showheader',false);
		if ($teamview->getActiveRecord() == null) {
			$currentrecord = "Record is unavailable";
		} else {
			$arec= $teamview->getActiveRecord();
			$currentrecord = $arec->getWins() . "-" . $arec->getLosses();
		}
		$record = array();
		$arec = $teamview->getActiveRecord();
		if ($arec != null) {
			$record[] = $arec;
		}
		$recordhistory = array_merge($record,$teamview->getRecordHistory());
		$rhtmpl->setObject('recordhistory',$recordhistory);
//		$content = $rhtmpl->getContent();
//		$ptmpl->setObject('recordhistoryhtml',$content);
		$ptmpl->addTemplate($rhtmpl);

		// Create Game History Wrapper Template
		$ghtmpl = new JLTemplate("gamehistory");
		$ghtmpl->setAlias("gamehistoryhtml");
		$ghtmpl->setObject('team', $row);
		$ghtmpl->setObject('helper',$viewhelper);
		$ghtmpl->setObject('showheader',false);
		$ghtmpl->setObject('mostrecentseason',$row->getSeason());
		
		// Craete Game History Table
		$ghttmpl = new JLTemplate("gamehistorytable");
		$ghttmpl->setAlias("gamehistorytablehtml");
		$ghttmpl->setObject('games',$teamview->getGameHistory());
		$ghttmpl->setObject('team', $row);
		$ghttmpl->setObject('helper',$viewhelper);		
//		$content = $ghttmpl->getContent();
		$ghtmpl->addTemplate($ghttmpl);
//		$ghtmpl->setObject('gamehistorytablehtml',$content);
//		$ptmpl->setObject('gamehistoryhtml',$ghtmpl->getContent());
		$ptmpl->addTemplate($ghtmpl);		

		$schedulehtml = new JLTemplate("teamprofile.schedule");
		$schedulehtml->setAlias("scheduleinformation");
		$schedulehtml->setObject('team',$row);
		$schedulehtml->setObject('games',$teamview->getSchedule());
		$schedulehtml->setObject('showheader',false);
		//$content = $schedulehtml->getContent();
		//$ptmpl->setObject('scheduleinformation',$content);
		$ptmpl->addTemplate($schedulehtml);

		$rosterhtml = new JLTemplate("teamprofile.roster");
		$rosterhtml->setAlias("rosterinformation");
		$rosterhtml->setObject('mostrecentseason',$row->getSeason());
		$rosterhtml->setObject('team',$row);
		$rosterhtml->setObject('showheader',false);
		
		// Create Roster Template
		$rttmpl = new JLTemplate("teamprofile.rostertable");
		$rsvc = & JLSimpleRosterService::getInstance();
		try {
			$roster = $teamview->getRoster();
			$rttmpl->setObject('roster',$roster);
			// Test to verify current user can view the roster
	        if (JLSecurityService::canViewRoster($row, $roster->getSeason())) {
				$players = $roster->getPlayers();
				$rttmpl->setObject('roster',$roster);
	        	$rttmpl->setObject('players',$players);			
				$content = $rttmpl->getContent();
	        } else {
	        	$players = array();
	        	$rttmpl->setObject('players',$players);        	
	        	$content = JLText::getText('JL_ROSTERS_NO_PERMISSION');		
	        }
	        $rosterhtml->setObject('rostertablehtml',$content);
			//$ptmpl->setObject('rosterinformation',$content);
		} catch (Exception $e) {
			$rosterhtml->setObject('rostertablehtml','Roster Unavailable');
		}
		$ptmpl->addTemplate($rosterhtml);
		$view->addTemplate($ptmpl);
		return $view;
    }

    
    private function buildTeamProfileView_old($keyid)
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_PLUGIN_PATH . DS . 'plgstandingsmodule.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'teamprofileviewhelper.php');  
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
				
		$svc = & JLTeamService::getInstance();
		$row = $svc->getRow($keyid);
	
		$config = $this->getConfig();
		$seasonid = $config->getPropertyValue('current_season');
		$games = $svc->getTeamGames($keyid,$row->getSeason()->getId());
		$schedule = $svc->getTeamSchedule($keyid,$row->getSeason()->getId());
		$yearsinleague = $svc->getYearsInLeague($keyid);
		$history = $svc->getRecordHistory($keyid,true);

		if (!is_object($row)) {
			echo JLText::getText('JL_TEAM_NOT_FOUND');
			return;
		}
		
		// update hit counter
		$svc->hit($row);
		
		$view = new JLTeamProfileView($row);
	        $view->addPathway(JLText::getText('JL_PW_LEAGUE_STANDINGS'),'index.php?option=com_jleague');		
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'));
		$view->addPathway(JLText::getText($row->getName()));
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.tabs.js');
		$view->addScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');
				
		// Add submenu to the profile 
		$submenu = $view->getSubmenu($row);
		$submenu2 = $view->getNewSubmenu($row);

		$context = array("team" => $row);
		$standings = JLStandingsModulePlugin::exec($context);
		
		$ptmpl = new JLTemplate("teamprofile-twocol");
		$ptmpl->setObject('team',$row);
		$ptmpl->setObject('mostrecentseason',$row->getSeason());
		$ptmpl->setObject('mostrecentdivision',$row->getDivision());
		$ptmpl->setObject('yearsinleague',$yearsinleague);
		$ptmpl->setObject('submenu',$submenu);
		$ptmpl->setObject('submenu2',$submenu2);
		$ptmpl->setObject('standings',$standings);
		
		$viewhelper = new JLTeamProfileViewHelper();
		
		// Retrieve the Team Contacts
		$contacts = $svc->getTeamContacts($row->getId());
		$ctmpl = new JLTemplate("teamprofile.contacts");
		$ctmpl->setObject('contacts',$contacts);
		$ctmpl->setObject('helper',$viewhelper);
		$ctmpl->setObject('showheader',false);
		$content = $ctmpl->getContent();
		$ptmpl->setObject("teamcontacts",$content);
		
		// Retrieve any venues/fields for a team
		$venues = $svc->getTeamVenues($keyid);
		$fieldinfo = new JLTemplate("teamprofile.fields");
		$fieldinfo->setObject('venues',$venues);
		$fieldinfo->setObject('showheader',false);
		$content = $fieldinfo->getContent();
		$ptmpl->setObject('fieldinformation',$content);
		
		// Retrieve the Record hisotry
		$rhtmpl = new JLTemplate("recordhistory");
		$rhtmpl->setObject('recordhistory',$history);
		$rhtmpl->setObject('showheader',false);
		$content = $rhtmpl->getContent();
		$ptmpl->setObject('recordhistoryhtml',$content);

		// Create Game History Wrapper Template
		$ghtmpl = new JLTemplate("gamehistory");
		$ghtmpl->setObject('team', $row);
		$ghtmpl->setObject('showheader',false);
		$ghtmpl->setObject('mostrecentseason',$row->getSeason());
		
		// Craete Game History Table
		$ghttmpl = new JLTemplate("gamehistorytable");
		$ghttmpl->setObject('games',$games);
		$content = $ghttmpl->getContent();
		$ghtmpl->setObject('gamehistorytablehtml',$content);
		$ptmpl->setObject('gamehistoryhtml',$ghtmpl->getContent());		

		$schedulehtml = new JLTemplate("teamprofile.schedule");
		$schedulehtml->setObject('team',$row);
		$schedulehtml->setObject('games',$schedule);
		$schedulehtml->setObject('showheader',false);
		$content = $schedulehtml->getContent();
		$ptmpl->setObject('scheduleinformation',$content);

		$rosterhtml = new JLTemplate("teamprofile.roster");
		$rosterhtml->setObject('mostrecentseason',$row->getSeason());
		$rosterhtml->setObject('team',$row);
		$rosterhtml->setObject('showheader',false);
		
		// Craete Game History Table
		$rttmpl = new JLTemplate("teamprofile.rostertable");
//		$ghttmpl->setObject('games',$games);
//		$content = $ghttmpl->getContent();
//		$ghtmpl->setObject('gamehistorytablehtml',$content);
//		$ptmpl->setObject('gamehistoryhtml',$ghtmpl->getContent());	
		$rsvc = & JLSimpleRosterService::getInstance();
		try {
			$roster = $rsvc->getRoster($row->getId());
			$rttmpl->setObject('roster',$roster);
			// Test to verify current user can view the roster
	        if (JLSecurityService::canViewRoster($row, $roster->getSeason())) {
				$players = $roster->getPlayers();
				$rttmpl->setObject('roster',$roster);
	        	$rttmpl->setObject('players',$players);			
				$content = $rttmpl->getContent();
	        } else {
	        	$players = array();
	        	$rttmpl->setObject('players',$players);        	
	        	$content = JLText::getText('JL_ROSTERS_NO_PERMISSION');		
	        }
	        $rosterhtml->setObject('rostertablehtml',$content);
			//$ptmpl->setObject('rosterinformation',$content);
		} catch (Exception $e) {
			$rosterhtml->setObject('rostertablehtml','Roster Unavailable');
		}
		$ptmpl->setObject('rosterinformation',$rosterhtml->getContent());
		$view->addTemplate($ptmpl);
		return $view;
    }
    
    
    function editTeamProfile() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		

        //capture Team ID
		$teamid = $this->getParam('teamid');
        
        // get team service
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
				
        $mainframe = JLApplication::getMainframe();
        
        if (!JLSecurityService::isAuthorizedTask($team)) {
        	$mainframe->redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $team->getSlug() , "NOT AUTHORIZED TO PERFORM EDIT FUNCTION " );
        }

		$view = new JLTeamProfileView();
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);		
		$view->addPathway(JLText::getText('JL_PW_EDIT_TEAM_PROFILE'));
				
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$tmpl = new JLTemplate('teamprofile.edit');
		$tmpl->setObject('team',$team);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$view->addTemplate($tmpl);
		$view->display();
		
    }
    
	function doUpdate() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		

		//capture Team ID
		$teamid = $this->getParam('teamid');

        // get team service
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
		
		$view = new JLTeamProfileView();
		$view->bindRequest($team);

		$mainframe = JLApplication::getMainframe();
		if (!$svc->save($team)) {
			$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_UNSUCCESSFUL') );
		}
		$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_SUCCESSFUL') );
		
	}

	function doFieldUpdate() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		

		//capture Team ID
		$teamid = $this->getParam('teamid');

        // get team service
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
		
		$view = new JLTeamProfileView();
		$view->bindRequest($team);

		$mainframe = JLApplication::getMainframe();
		if (!$svc->save($team)) {
			$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_UNSUCCESSFUL') );
		}
		$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_SUCCESSFUL') );
		
		
	}
	
	/**
	 * This is an AJAX function to retrieve a teams game history for a specific season.  This
	 * should include COMPLETED games only.  Any scheduled games should be retrieved via another
	 * function.
	 *
	 */
	function ajaxGetGameHistory()
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
    	
        $teamid = JLUtil::getRequestParam('teamid');
        $seasonid = JLUtil::getRequestParam('seasonid');

		// Find most recent service
		$svc = & JLTeamService::getInstance();
		$games = $svc->getTeamGames($teamid,$seasonid);
		if (!count($games)) {
			echo JLText::getText('JL_GAMEDATA_NOT_FOUND');
			return;
		}
		$view = new JLTeamProfileView();
		$tableview = new JLTemplate("gamehistorytable");
		$tableview->setObject('games',$games);
		$view->addTemplate($tableview);
		$view->suppressCommonLibraries();
		$view->display();
    }
    
	function ajaxGetRosterHistory()
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
    	
        $teamid = JLUtil::getRequestParam('teamid');
        $seasonid = JLUtil::getRequestParam('seasonid');

		// Find most recent service
		$rsvc = & JLSimpleRosterService::getInstance();
		$view = new JLTeamProfileView();
		$tableview = new JLTemplate("teamprofile.rostertable");
		try {
			$roster = $rsvc->getRoster($teamid, $seasonid);
			if (!count($roster)) {
				echo JLText::getText('Roster Information Unavailable');
				return;
			}
			// Test to verify current user can view the roster
			/*
	        if (JLSecurityService::canViewRoster($row, $roster->getSeason())) {
				$players = $roster->getPlayers();
				$tableview->setObject('roster',$roster);
	        	$tableview->setObject('players',$players);			
	        } else {
	        	$players = array();
	        	$tableview->setObject('players',$players);        	
	        }
			*/
				$players = $roster->getPlayers();
				$tableview->setObject('roster',$roster);
	        	$tableview->setObject('players',$players);			
		} catch (Exception $e) {
			$tableview->setObject('rostertablehtml','Roster Unavailable');
		}
//		$ptmpl->setObject('rosterinformation',$rosterhtml->getContent());
		$view->addTemplate($tableview);
		$view->suppressCommonLibraries();
		$view->display();
	}

	/**
	 * This function will render the page used to allow the user to enter a filename to 
	 * upload as the team logo.
	 *
	 */
    function uploadLogo() {
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');        
        
		$config = $this->getConfig();

		//capture Team ID
		$teamid = $this->getParam('teamid');
		//@todo perform authorization validation
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
		
		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);
		$view->addPathway(JLText::getText('JL_PW_UPLOAD_LOGO'));
		$tmpl = new JLTemplate("uploadlogo");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$view->addTemplate($tmpl);
		$view->display();
    }
    
    /**
     * This function actually executes the upload of the teams logo and creates the image in the right directory.
     * It will also create the thumbnail.
     *
     */
    function executeUploadLogo() {
    	//require_once(JLEAGUE_LIBRARIES_PATH . DS . 'image.php'); 
    	require_once(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries'. DS . 'image2.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		    	
    	$config = $this->getConfig();
    	$teamid = $this->getParam('teamid');
		
		$svc =  & JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
				
        jimport('joomla.filesystem.file');
                
    	$file = JRequest::getVar( 'Filedata', '', 'files', 'array' );
		$folder = JPATH_ROOT.DS.$config->getProperty('logo_folder');
    	$filename=$teamid . "_". strtolower(str_replace(' ','_',$file['name']));
    	$filepath	= JPath::clean($folder.$filename);
		
		JRequest::setVar( 'filename', $file['name'], 'post' );
		
		if (!JFile::upload($file['tmp_name'], $filepath))
		{
			JError::raiseWarning(100, JLText::getText('Error. Unable to upload file'));
			return;
		}    	
		
	   $image = new SimpleImage();
	   $image->load($folder . DS . $filename);
	   $image->resize($config->getProperty('max_logo_width'),$config->getProperty('max_logo_height'));
	   $image->save($filepath );
	   $image->resize($config->getProperty('max_thumbnail_width'),$config->getProperty('max_thumbnail_height'));
	   $image->save($folder . DS . "thumb-".$filename);
		
		$team->setLogo($filename);
		$mainframe = JLApplication::getMainframe();
		if (!$svc->save($team)) {
			$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_UNSUCCESSFUL') );
		}
		$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_SUCCESSFUL') );
    }

	function listteams() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'listteams.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');		
		
		$svc = & JLTeamService::getInstance();

		$seasonsvc = & JLSeasonService::getInstance();
		// Try to get the currently ACTIVE season.  If not available, then get the most 
		// recent season.
		try {
			$season = $seasonsvc->getMostRecentSeason();
		} catch (Exception $e) {
			throw $e;
		}

		$filter = JLHtml::getSeasonSelectList('seasonid', $season->getId(),true,'onchange="getTeamsForSeason(this.value);"');

		$teams = $svc->getTeamsInSeason($season->getId(),1);
		
		$view = new JLListTeamsView();
		$view->addPathway(JLText::getText('JL_PW_TEAM_LIST'));
		
		$wrapper = new JLTemplate('listteams');
		$wrapper->setObject('season',$season);
		$wrapper->setObject('filter',$filter);
				
		$tableview = new JLTemplate('listteamsresults');
		$tableview->setObject('teams',$teams);
		$tableview->setObject('totalteams',sizeof($teams));
		$tableview->setObject('season',$season);
		$wrapper->addTemplate($tableview);
		$view->addTemplate($wrapper);
		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/popup.css');
		$view->addScript(JURI::root() . 'components/com_jleague/js/popup.js');
		$view->display();
				
	}
	
	function manageContacts() {
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');        
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        
		$config = $this->getConfig();

		//capture Team ID
		$teamid = $this->getParam('teamid');
		//@todo perform authorization validation
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);
		
        require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
        if (!JLSecurityService::isAuthorizedTask($team)) {
   		    $mainframe = JLApplication::getMainframe();
        	$mainframe->redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "NOT AUTHORIZED TO PERFORM EDIT FUNCTION " );
        }
        
		$contacts = $svc->getTeamContacts($teamid);
		
		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);
		$view->addPathway(JLText::getText('JL_PW_MANAGE_CONTACTS'));
		$tmpl = new JLTemplate("managecontacts");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$tmpl2 = new JLTemplate("currentcontactstable");
		$tmpl2->setObject('contacts',$contacts);	
		$tmpl->setObject('currentcontactstable',$tmpl2->getContent());	
		$view->addTemplate($tmpl);
		$view->display();	
	}
	
	function ajaxRemoveTeamContact() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		$service = JLTeamService::getInstance();
		$contactid = null;
		$teamid = null;
		if (isset($_REQUEST["id"])) {
			$contactid = $_REQUEST["id"];
		}
		if (!$service->removeTeamContact($contactid)) {
			echo "ERROR:  Removal Team Contact failed";
			return;
		}
		if (isset($_REQUEST["teamid"])) {
			$teamid = $_REQUEST["teamid"];
		} 
		$contacts = $service->getTeamContacts($teamid);
		$tmpl = new JLTemplate("currentcontactstable");
		$tmpl->setObject('contacts',$contacts);
		$html = $tmpl->getContent();
		echo $html;
	}
	
	function ajaxAddTeamContact() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'teamcontact.class.php');
		
		if (!isset($_REQUEST["teamid"])) {
			echo "ERROR:  Missing TEAM ID value";
			return;
		}
		
		$service = JLTeamService::getInstance()	;
		$teamid = $_REQUEST["teamid"];
		$contact = new JLTeamContact();
		$contact->setId(0);
		$contact->setTeamId($teamid);
		if (isset($_REQUEST["contactname"])) {
			$contact->setName($_REQUEST["contactname"]);
		}
		if (isset($_REQUEST["contactphone"])) {
			$contact->setPhone($_REQUEST["contactphone"]);
		}
		if (isset($_REQUEST["contactemail"])) {		
			$contact->setEmail($_REQUEST["contactemail"]);
		}
		if (isset($_REQUEST["userid"])) {
			$contact->setUserid($_REQUEST["userid"]);
		}
		if (isset($_REQUEST["role"])) {			
			$contact->setRole($_REQUEST["role"]);
		}
		if (!$service->addTeamContact($contact)) {
			echo "ERROR:  Add Team Contact failed";
			return;
		}
		$contacts = $service->getTeamContacts($teamid);
		$tmpl = new JLTemplate("currentcontactstable");
		$tmpl->setObject('contacts',$contacts);
		$html = $tmpl->getContent();
		echo $html;
	}		

	function updateFieldInfo() {
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');        
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        
		$config = $this->getConfig();

		//capture Team ID
		$teamid = $this->getParam('teamid');
		//@todo perform authorization validation
		$svc = &JLTeamService::getInstance();
		$team = $svc->getRow($teamid);

		$venues = $svc->getTeamVenues($teamid);
		
		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);
		$view->addPathway(JLText::getText('JL_PW_EDIT_FIELD_INFORMATION'));
//		$tmpl = new JLTemplate("fieldinformation.edit");
		$tmpl = new JLTemplate("managefields");
		$tmpl->setObject('team',$team);
		$tmpl2 = new JLTemplate("currentvenuestable");
		$tmpl2->setObject('venues',$venues);	
		$tmpl2->setObject('teamid',$teamid);
		$tmpl->setObject('currentvenuestable',$tmpl2->getContent());	
		
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$view->addTemplate($tmpl);
		$view->display();		
	}
	
	
	function ajaxAddTeamVenue() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'teamcontact.class.php');
		
		if (!isset($_REQUEST["teamid"])) {
			echo "ERROR:  Missing TEAM ID value";
			return;
		}
		if (!isset($_REQUEST["venueid"])) {
			echo "ERROR:  Missing VENUE ID value";
			return;
		}
		
		$service = JLTeamService::getInstance()	;
		$teamid = $_REQUEST["teamid"];
		$venueid = $_REQUEST["venueid"];
		if (!$service->addTeamVenue($teamid, $venueid)) {
			echo "ERROR:  Add Team Venue failed";
			return;
		}
		$venues = $service->getTeamVenues($teamid);
		$tmpl = new JLTemplate("currentvenuestable");
		$tmpl->setObject('teamid',$teamid);
		$tmpl->setObject('venues',$venues);
		$html = $tmpl->getContent();
		echo $html;
	}			
	
	function ajaxRemoveTeamVenue() {
		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'teamcontact.class.php');
		
		if (!isset($_REQUEST["teamid"])) {
			echo "ERROR:  Missing TEAM ID value";
			return;
		}
		if (!isset($_REQUEST["venueid"])) {
			echo "ERROR:  Missing VENUE ID value";
			return;
		}
		
		$service = & JLTeamService::getInstance()	;
		$teamid = $_REQUEST["teamid"];
		$venueid = $_REQUEST["venueid"];
		if (!$service->removeTeamVenue($teamid, $venueid)) {
			echo "ERROR:  Remove Team Venue failed";
			return;
		}
		$venues = $service->getTeamVenues($teamid);
		$tmpl = new JLTemplate("currentvenuestable");
		$tmpl->setObject('teamid',$teamid);
		$tmpl->setObject('venues',$venues);
		$html = $tmpl->getContent();
		echo $html;
	}				
	
	function manageSchedule() {
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');        
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'gameviewhelper.php');
        
		$config = $this->getConfig();
		$seasonid = $config->getPropertyValue('current_season');

		//capture Team ID
		$teamid = $this->getParam('teamid');
		//@todo perform authorization validation
		$svc = JLTeamService::getInstance();
		$team = $svc->getRow($teamid);

		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
        if (!JLSecurityService::isAuthorizedTask($team)) {
   		    //$mainframe = JLApplication::getMainframe();
        	JLApplication::redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "NOT AUTHORIZED TO PERFORM EDIT FUNCTION " , "error");
        }
		
		
		$seasonsvc = & JLSeasonService::getInstance();
		try {
			$season = $seasonsvc->getActiveSeason();
		} catch (Exception $e) {
        	JLApplication::redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "CANNOT MANAGE SCHEDULE WITHOUT AN ACTIVE SEASON AVAILABLE", "error" );			
		}
		
		$obj = & JLFactory::createGame();
		$obj->setSeason($season->getId());
		$obj->setDivisionId($team->getDivision()->getId());

		$viewhelper = new JLGameViewHelper($obj);
		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);
		$view->addPathway(JLText::getText('JL_PW_SUBMIT_SCORE'));
		$view->addScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');		
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.core.js');
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.tabs.js');
		$view->addScript(JURI::root() . 'components/com_jleague/js/date.js');
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.dialog.js');
	
		$tmpl = new JLTemplate("manageschedule");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('game',$obj);
		$tmpl->setObject('season',$season);
		$tmpl->setObject('helper',$viewhelper);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$view->addTemplate($tmpl);
		
		$tservice = & JLTeamService::getInstance();
		$games = $tservice->getAllTeamGames($teamid,$season->getId());
		
		$tmpl2 = new JLTemplate("scheduletable");
		$tmpl2->setObject('games',$games);
		$tmpl2->setObject('teamid',$team->getId());
		$tmpl2->setObject('helper',$viewhelper);
		$currentgamestable = $tmpl2->getContent();
		
		$tmpl->setObject('currentseasonsgames',$currentgamestable);
//		$html = $tmpl->getContent();
		$view->display();		
	}	

	function doSubmitScore() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
		$view = new JLTeamProfileView();
		$game = $view->bindRequestToGameObject();
		$teamid = $_REQUEST["teamid"];
		
		$svc = & JLGamesService::getInstance();
		$mainframe = JLApplication::getMainframe();
		if (!$svc->save($game)) {
			$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_UNSUCCESSFUL') );
		}
		$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid) , JLText::getText('JL_RECORD_SAVE_SUCCESSFUL') );		
	}
	
	function manageRoster() {
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'playerservice.class.php');        
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');        
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');

		$config = $this->getConfig();

		//capture Team ID
		$teamid = $this->getParam('teamid');
		
		//@todo perform authorization validation
		$svc = & JLTeamService::getInstance();
		$psvc = & JLPlayerService::getInstance();
	
		$team = $svc->getRow($teamid);

		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
	    //$mainframe = JLApplication::getMainframe();
        if (!JLSecurityService::isAuthorizedTask($team)) {
        	JLApplication::redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "NOT AUTHORIZED TO PERFORM EDIT FUNCTION " );
        }

		$ssvc = & JLSeasonService::getInstance();
		try {
			$season = $ssvc->getActiveSeason();
		} catch (Exception $e) {
        	JLApplication::redirect( "index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $teamid , "CANNOT MANAGE ROSTER WITHOUT AN ACTIVE SEASON AVAILABLE" );			
		}
        
		// Get Roster / Players
		$rsvc = & JLSimpleRosterService::getInstance();
		$roster = $rsvc->getRoster($teamid, $season->getId());

//		if ($roster->getId() == 0) {
//			$this->displayCreateRosterPrompt($team,$season,$roster);
//		} else {
			$this->displayManageRoster($team,$season,$roster);
//		}
	}
	
	private function displayCreateRosterPrompt($team, $season, $roster) {
		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$team->getId());
		$view->addPathway(JLText::getText('JL_PW_MANAGE_ROSTER'));
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.dialog.js');
		$view->addScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');
		$view->addScript(JURI::root() . 'components/com_jleague/js/date.js');
//		$view->addScript(JURI::root() . 'components/com_jleague/js/webtoolkit.scrollabletable.js');
		$tmpl = new JLTemplate("createrosterprompt");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$tmpl->setObject('roster',$roster);
		$tmpl->setObject('season',$season);
		$view->addTemplate($tmpl);
		$view->display();

	}

	private function displayManageRoster($team, $season, $roster) {
		$teamid = $team->getId();
		$players = $roster->getPlayers();

		$view = new JLTeamProfileView();
		$submenu = $view->getSubmenu($team);
		$submenu2 = $view->getNewSubmenu($team);
		$view->addPathway(JLText::getText('JL_PW_TEAM_PROFILE'),'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='.$teamid);
		$view->addPathway(JLText::getText('JL_PW_MANAGE_ROSTER'));
//		$view->addScript(JURI::root() . 'components/com_jleague/js/ui.dialog.js');
		$view->addScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');		
		$tmpl = new JLTemplate("manageroster");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('submenu',$submenu);
		$tmpl->setObject('submenu2',$submenu2);
		$tmpl->setObject('roster',$roster);
		$tmpl->setObject('season',$season);

		$tmpl2 = new JLTemplate("currentrostertable");
		$tmpl2->setObject('seasonid',$season->getId());
		$tmpl2->setObject('teamid',$teamid);
		$tmpl2->setObject('roster',$roster);
		$tmpl2->setObject('players',$players);
		$tmpl->setObject('currentrostertable',$tmpl2->getContent());
		$view->addTemplate($tmpl);
		$view->display();
	}

	
	function ajaxRemovePlayerFromRoster() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'roster.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'player.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'rosterservice.class.php');
		
		if (!isset($_REQUEST["teamid"])) {
			echo "ERROR:  Missing TEAMID value";
			return;
		}
		$teamid = $_REQUEST["teamid"];
		if (!isset($_REQUEST["seasonid"])) {
			echo "ERROR:  Missing SEASONDID value";
			return;
		}
		$seasonid = $_REQUEST["seasonid"];
		if (!isset($_REQUEST["id"])) {
			echo "ERROR:  Missing ID value";
			return;
		}
		$id = $_REQUEST["id"];
				
		$service = & JLRosterService::getInstance();
		try {
			$service->removePlayerFromRoster($id,$teamid,$seasonid);
		} catch (Exception $e) {
			echo $e->getMessage();
			return;
		}
		
		try {
			$roster= $service->getTeamRoster($teamid,$seasonid);
		} catch (Exception $e) {
			echo $e->getMessage();
			return;
		}
		$players = $roster->getPlayers();			
		$tmpl = new JLTemplate("currentrostertable");
		$players = $roster->getPlayers();
		$tmpl->setObject('players',$players);
		$tmpl->setObject('seasonid',$seasonid);
		$tmpl->setObject('teamid',$teamid);		
		$html = $tmpl->getContent();
		echo $html;
	}			

	/**
	 * This function will generate a list of team contacts for the specific user for the 
	 * current/active season.  
	 *
	 */
	function getteamcontactlist() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'userservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		require_once(JLEAGUE_VIEWS_PATH . DS . 'contacts.php');

		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getMostRecentSeason();
				
	    if (!JLSecurityService::isAuthorizedTask($season)) {
   		    $mainframe = JLApplication::getMainframe();
   		    $msg = "Access to detailed team contact information is restricted.  Only coaches/managers and league administrators can perform this function.  ";
   		    $msg .= "If you believe you received this message in error, please email " . JLApplication::cloakEmail("support@swibl-baseball.org");
  		    $mainframe->redirect( "index.php" , $msg , 'error');
   		    return;
        }

		$agegroups = JLUserService::getInterestedAgeGroups($season->getId());

		$svc = & JLDivisionService::getInstance();
		$divisions = $svc->getDivisionsWithinAgeGroup($season->getId(), $agegroups);
		$tsvc = &JLTeamService::getInstance();
		$teams = $tsvc->getTeamsInDivisions($divisions);
	
		$view = new JLContactsView();
		$view->addPathway(JLText::getText('JL_PW_TEAM_CONTACTS'));
		
		$tmpl = new JLTemplate('teamcontacts');
		$tmpl->setObject('season',$season);
		$tmpl->setObject('teams',$teams);
//		$tableview = new JLTemplate('listteamsresults');
//		$tableview->setObject('teams',$teams);
//		$tableview->setObject('totalteams',sizeof($teams));
//		$tableview->setObject('season',$season);
//		$wrapper->addTemplate($tableview);
		$view->addTemplate($tmpl);
		$view->display();
		
	}

	function ajaxGetTeamPopup() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');		
        require_once(JLEAGUE_VIEWS_PATH . DS . 'teamprofile.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'teamprofileviewhelper.php');        
		
        $keyid = JLUtil::getRequestParam('teamid');
        if (!is_numeric($keyid)) {
        	JError::raiseError( 500, "ID is not numeric (teams.php::ajaxGetTeamPopup)");
        }
/*
        $cache = &JLCache::getInstance();
        try {
        	$content = $cache->get("ajaxGetTeamPopup",$keyid);
        	$html = $content;
        } catch (Exception $e) {       
	        // Find most recent service
*/
			$svc = & JLTeamService::getInstance();
			//$team = $svc->getRow($keyid);
			$teamview = $svc->getTeamView($keyid);
			$team = $teamview->getTeam();
			$yearsinleague = $svc->getYearsInLeague($keyid);
			$history = $svc->getRecordHistory($keyid,true);
			$tmpl = new JLTemplate("teampopup");
			$tmpl->setObject('team',$team);
			$tmpl->setObject('yearsinleague',$yearsinleague);
			$tmpl->setObject('recordhistory',$history);
			$html = $tmpl->getContent();
//			$cache->store("ajaxGetTeamPopup",$keyid,$html);
//        }
		echo $html;
	}
	
	 
	function exportGameInformation() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		$svc = & JLTeamService::getInstance();
		if (isset($_REQUEST["teamid"])) {
			$teamid = $_REQUEST["teamid"];
		} else {
			echo "ERROR:  Cannot export game information.  Missing Team ID";
			return; 
		}
		if (isset($_REQUEST["season"])) {
			$season = $_REQUEST["season"];
		} else {
			echo "ERROR:  Cannot export game information.  Missing SEASON";
			return; 
		}
				
		$teamview = $svc->getTeamView($teamid);
		$team = $teamview->getTeam();
		$games = $svc->getTeamGames($teamid, $season, "'C'");
		
		$filename ="swibl-game-scores";
		
      	header("Content-type: application/octet-stream");
      	header("Content-Disposition: attachment; filename=".$filename.".xls");
    	header("Pragma: no-cache");
    	header("Expires: 0");

    	//SELECT s.id as 'game_id', game_date, d.agegroup as 'agegroup', t1.name as 'home_team', hometeam_score, t2.name as 'away_team', awayteam_score
    	echo "TEAMNAME:  " . $team->getName() . "\n";
    	echo "HEAD COACH:  " . $team->getCoachName() . "\n";
    	echo "USSSA #: " . $team->getFieldValue("FLD_USSSA_NUMBER") . "\n\n";
		echo "game_id \t game_date \t home_team\t hometeam_score\t away_team \t awayteam_score \t\n";
		foreach ($games as $game) {
			if ($game->isLeagueGame()) {
				$line = $game->getId() .  "\t"
					. '"' . $game->getGameDate() . '"' . "\t" 
					. '"' . $game->getGameDate() . '"' . "\t" 
					. '"' . str_replace("'","",$game->getHometeam()) . '"' . "\t"
					. '"' .  $game->getHometeamScore() . '"' . "\t"
					. '"' .  $game->getAwayteam() . ' "' . "\t"
					. '"' .  str_replace("'","",$game->getAwayteamScore()) . '"' . "\t"
					. " \n "; 
				echo $line;
			}
		}
		die;
	}

	/*
	function calcRPI() {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		$svc = & JLTeamService::getInstance();
		$teamid = 315;
		$season = 8;
		$svc->calculateRPI($teamid, $season);
	}
	*/
	
	function batchCalcRPI() {
		$ssvc = &JLSecurityService::getInstance();
		if ($ssvc->isAdmin()) {
	        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
	   		$db	=& JLApp::getDBO();
	
			$svc = & JLTeamService::getInstance();
			$season = 8;
			$teams = $svc->getTeamsInSeason($season);
			foreach ($teams as $team) {
				$rpi = $svc->calculateRPI($team->getId(), $season);
				//echo "Team: " . $team->getName() . "(".$team->getId().") " . $team->getDivision()->getAgeGroup() . " RPI = " . $rpi . "<br/>";
				$query = "insert into jos_jleague_rpi (id,rpi) values (" . $team->getId() . ", " . $rpi .")";
		    	$db->setQuery($query);
		    	$db->query(); 
			}
		} else {
			echo JLText::getText('WARNING:  Unauthorized Access');
		}
			
	}
	
	function batchCalcStats() {
		$ssvc = &JLSecurityService::getInstance();
		if ($ssvc->isAdmin()) {
	        require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
	        $svc = &JLTeamService::getInstance();
	        $svc->calculateTeamStats(8);
		} else {
			echo JLText::getText('WARNING:  Unauthorized Access');
		}
	}
	

}

?>
