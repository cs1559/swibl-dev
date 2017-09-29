<?php
/**
 * @version		$Id: controller.php 319 2011-12-24 10:06:57Z Chris Strieter $
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
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
 
/**
 */
class JLeagueController extends JController
{
	private $_config = null;
	
	function __construct() {
		parent::__construct();
		$this->loadLanguage();	
	}
	
	private function loadLanguage() {
	    // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );
	}
	protected function getConfig() {
		$this->_config = JLApplication::getConfig();
		return $this->_config;
	}
	
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
       $mainframe = JLApplication::getMainframe();
        if (isset($_REQUEST['Itemid'])) {
           $itemid = "&Itemid=" . $_REQUEST['Itemid'];
        } else {
           $itemid = "&Itemid=181";
        }
       	$mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=standings&task=displayStandings" . $itemid ));    	
   	
    }
 
    function displayStandings()
    {
       $mainframe = JLApplication::getMainframe();
        if (isset($_REQUEST['Itemid'])) {
           $itemid = "&Itemid=" . $_REQUEST['Itemid'];
        } else {
           $itemid = "&Itemid=181";
        }
        $mainframe->redirect( JRoute::_("index.php?option=com_jleague&controller=standings&task=displayStandings" . $itemid ));    	
   	
    }
    
    function frontpage() {
    	$config = &JLConfig::getInstance();
    	$fmt = $config->getProperty('frontpage_format');
    	switch ($fmt) {
    		case 'upcominggames':
    			$this->frontpageupcomingcames();
    			break;
    		case 'scoreboard':
    			$this->frontpagescoreboard();
    			break;
    		default:
    			$this->frontpageupcomingcames();
    			break;
    	}
    }

   function frontpageupcomingcames()
    {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');       
        require_once(JLEAGUE_VIEWS_PATH . DS . 'scoreboard.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        
        // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );

    	$config = &JLConfig::getInstance();
    	$days = $config->getProperty('frontpage_upcoming_games_days');
    	$maxgames = $config->getProperty('frontpage_upcoming_games_games');
    	$itemid = $config->getProperty('frontpage_upcoming_games_readmoreitemid');
    			
		$svc =  & JLGamesService::getInstance();
		//$games = $svc->getMostRecentGamesForSeason();
		$games = $svc->getUpcomingGames($days,$maxgames);	
		
		$view = new JLScoreboardView();
		$tmpl = new JLTemplate("upcominggames");
		$tmpl->setObject('games',$games);
		$viewmorelink = JRoute::_( "index.php?option=com_jleague&controller=games&task=listupcominggames&Itemid=".$itemid);
		$tmpl->setObject('readmore','<a href="'.$viewmorelink.'">View More ...</a>');
		$tmpl->setObject('showlocation',false);
		$tmpl->setObject('showtime',false);
		$view->addTemplate($tmpl);
        $view->display();
    }      
    function frontpagescoreboard()
    {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');       
        require_once(JLEAGUE_VIEWS_PATH . DS . 'scoreboard.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        
        // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );
		
		$svc = JLGamesService::getInstance();
		$games = $svc->getMostRecentGamesForSeason(null,24);
		
		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();
		$curgames= $svc->getMostRecentGamesForSeason($season->getId());
		
		if (count($curgames)>0) {
			$msg = '';
		} else {
			$msg = JLText::getText('JL_LISTING_PREVIOUS_SEASON_GAMES');
		}
		
		$view = new JLScoreboardView();
		$tmpl = new JLTemplate("frontpagescoreboard");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('message',$msg);
		$view->addTemplate($tmpl);
        $view->display();
    }    

    function listteams() {
        if (isset($_REQUEST['Itemid'])) {
           $itemid = "&Itemid=" . $_REQUEST['Itemid'];
        } else {
           $itemid = "";
        }
        $mainframe = JLApplication::getMainframe();
       	$mainframe->redirect( "index.php?option=com_jleague&controller=teams&task=listteams". $itemid  );
    }
    
   function listupcominggames() {
        if (isset($_REQUEST['Itemid'])) {
           $itemid = "&Itemid=" . $_REQUEST['Itemid'];
        } else {
           $itemid = "";
        }
   	
        $mainframe = JLApplication::getMainframe();
       	$mainframe->redirect( "index.php?option=com_jleague&controller=games&task=listupcominggames" . $itemid);
    }
        
    function listleaguecontacts() {
    	require_once(JLEAGUE_VIEWS_PATH . DS . 'leaguecontacts.php');
    	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');

    	$svc = JLDivisionService::getInstance();
    	$divisions = $svc->getCurrentDIvisions();
    	$view = new JLLeagueContactsView();
    	$tmpl = new JLTemplate("leaguecontacts");
    	$tmpl->setObject('divisions',$divisions);
    	$view->addTemplate($tmpl);
    	$view->display();
    }
    
	function getParam($parm) {
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		return JLUtil::getRequestParam($parm);
	}
	
	function logoutlink() {
        $mainframe = JLApplication::getMainframe();
       	$mainframe->redirect( "index.php?option=com_user&task=logout&return=" . base64_encode(JURI::base()) );
		
	}
	
	function setUserPreferences() {
    	require_once(JLEAGUE_VIEWS_PATH . DS . 'userpreferences.php');
    	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'preferenceservice.class.php');
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
    	
    	$ssvc = & JLSecurityService::getInstance();
    	if (!$ssvc->isLoggedIn()) {
    		$mainframe = JLApplication::getMainframe();
	    	$mainframe->redirect( "index.php" , JLText::getText('JL_NOT_AUTHORIZED'));    		
    		return;
    	}
    	
    	$svc = & JLPreferenceService::getInstance();
    	$prefs = $svc->getUserPreferences();
    	
		$view = new JLUserPreferencesView();
    	$tmpl = new JLTemplate("userpreferences");
    	$tmpl->setObject('prefs',$prefs);
    	$view->addTemplate($tmpl);
    	$view->display();
	}
	
   function leaguescoreboard()
    {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');       
        require_once(JLEAGUE_VIEWS_PATH . DS . 'scoreboard.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'gamesservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        
        // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );
		
		$svc = JLGamesService::getInstance();

		$ssvc = &JLSeasonService::getInstance();
		$season = $ssvc->getActiveSeason();
		$curgames= $svc->getMostRecentGamesForSeason($season->getId());
		
		if (count($curgames)>0) {
			$msg = '';
			$games = $curgames;
		} else {
			$msg = JLText::getText('JL_LISTING_PREVIOUS_SEASON_GAMES');
		}
		
		$games = $svc->getMostRecentGamesForSeason($season->getId(),24);

		$view = new JLScoreboardView();
		$tmpl = new JLTemplate("scoreboard");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('message',$msg);
		$view->addTemplate($tmpl);
        $view->display();
    }  	

	function getteamcontactlist() {
		$mainframe = JLApplication::getMainframe();
       	$mainframe->redirect( "index.php?option=com_jleague&controller=teams&task=getteamcontactlist" . $itemid);
	}

	/**
	 * This function will display the contents of the configuration.  This is for
	 * ADMIN accounts only.
	 *
	 */
	function checkconfig() {
		$svc = & JLSecurityService::getInstance();
		if ($svc->isAdmin()) {
			$config = JLApplication::getConfig();
			echo "<pre>";
			print_r($config);
			echo "</pre>";
		} else {
			echo JLText::getText('WARNING:  Unauthorized Access');
		}
	}
	
}

?>
