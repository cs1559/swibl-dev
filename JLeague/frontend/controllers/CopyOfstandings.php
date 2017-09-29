<?php
/**
 * @version		$Id: standings.php 297 2011-11-20 12:58:45Z Chris Strieter $
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
 

class JLeagueControllerStandings extends JController
{
	
	function display()
    {
    	$this->displayStandings();
    }
    
    function displayStandings() {
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'registrationservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
        require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'standingsdao.class.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'standings.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');	
        
		JLApplication::loadLanguage();

		// Get League ID from the installations configuration
		$config = JLConfig::getInstance();
		$leagueid = $config->getLeagueId();
		
		if (isset($_REQUEST['divid'])) {
			$divid = $_REQUEST['divid'];
		} else {
			$divid = null;
		}
		// Find most recent service
		$seasonsvc = &JLSeasonService::getInstance();
		if (isset($_REQUEST['seasonid'])) {
			$season = $seasonsvc->getRow($_REQUEST['seasonid']);
		} else {
			$season = $seasonsvc->getMostRecentSeason();
		}
		if (!is_object($season)) {
			echo JLText::getText('JL_MOST_RECENT_SEASON_NOT_FOUND');
			return;
		}
		$filter = JLHtml::getSeasonSelectList('seasonid', $season->getId(),true,'onchange="getStandings(' . $leagueid . ',this.value);"');

		$view = new JLStandingsView();
		$view->addPathway(JLText::getText('JL_PW_LEAGUE_STANDINGS'));
		
		$wrapper = new JLTemplate('standings');
		$wrapper->setObject('season',$season);
		$wrapper->setObject('filter',$filter);

		if ($season->getStatus() != "P") {		
			// Get standings
			$standingssvc = &JLStandingsService::getInstance();
			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(),$divid);			
	
			$tableview = new JLTemplate("standingstable");
			$tableview->setObject('standings',$rows);
			$tableview->setObject('season',$season);
			$dao = &JLFactory::getDivisionDao();
			$dsvc = &JLDivisionService::getInstance();
			$divisions = $dsvc->getDivisionsForSeason($season->getId());
			$divisionlinks = $view->getDivisionLinks($divisions);
			$tableview->setObject('divdao',$dao);
			$tableview->setObject('divisionlinks',$divisionlinks);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$wrapper->addTemplate($tableview);
		} else {
			$tableview = new JLTemplate("lookwhoscoming");
			$regsvc = &JLRegistrationService::getInstance();
			$registrations = $regsvc->getRegisteredTeams($season->getId());
			$tableview->setObject('season',$season);		
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$tableview->setObject('registrations',$registrations);
			$wrapper->setObject('standingstable',$tableview->getContent());
		}
		$view->addTemplate($wrapper);
        $view->display();
    }
    
    function __construct()
    {
    	parent::__construct();
		
    } 

    function printStandings()
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'standingsdao.class.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'standings.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');	

        $leagueid = JLUtil::getRequestParam('leagueid');
        $seasonid = JLUtil::getRequestParam('seasonid');
        
    		if (isset($_REQUEST['divid'])) {
			$divid = $_REQUEST['divid'];
		} else {
			$divid = null;
		}
		        
        // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );

		// Find most recent service
		$seasonsvc = JLSeasonService::getInstance();
		$season = $seasonsvc->getRow($seasonid);
		if (!is_object($season)) {
			echo JLText::getText('JL_SEASON_NOT_FOUND');
			return;
		}
	
		
		// Get standings
		$standingssvc = &JLStandingsService::getInstance();
		$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(), $divid);
		
		$view = new JLStandingsView();

		$dsvc = &JLDivisionService::getInstance();
		$divisions = $dsvc->getDivisionsForSeason($season->getId());
		$divisionlinks = $view->getDivisionLinks($divisions);
		
		$tableview = new JLTemplate("standingstable");
		$tableview->setObject('standings',$rows);
		$tableview->setObject('season',$season);
		$tableview->setObject('season_note',$view->getSeasonStatus($season));
		$dao = &JLFactory::getDivisionDao();
		$tableview->setObject('divdao',$dao);
		$tableview->setObject('divisionlinks',$divisionlinks);  		
		$view->addTemplate($tableview);		
		$view->suppressCommonLibraries();
		$view->display();
    }

 
    
    
    function ajaxGetStandings()
    {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'registrationservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
        require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
        require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'standingsdao.class.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
        require_once(JLEAGUE_VIEWS_PATH . DS . 'standings.php');
        require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
        require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');	

        $leagueid = JLUtil::getRequestParam('leagueid');
        $seasonid = JLUtil::getRequestParam('seasonid');
        
   		if (isset($_REQUEST['divid'])) {
			$divid = $_REQUEST['divid'];
		} else {
			$divid = null;
		}
		        
        // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );

		// Find most recent service
		$seasonsvc = JLSeasonService::getInstance();
		$season = $seasonsvc->getRow($seasonid);
		if (!is_object($season)) {
			echo JLText::getText('JL_SEASON_NOT_FOUND');
			return;
		}

		$view = new JLStandingsView();
				
		// Get standings
		$standingssvc = &JLStandingsService::getInstance();
		
		if ($season->getStatus() != "P") {
			$rows = $standingssvc->getStandings((int) $leagueid, (int) $season->getId(), $divid);
			
			$dsvc = &JLDivisionService::getInstance();
			$divisions = $dsvc->getDivisionsForSeason($season->getId());
			$divisionlinks = $view->getDivisionLinks($divisions);
			
			$tableview = new JLTemplate("standingstable");
			$tableview->setObject('standings',$rows);
			$tableview->setObject('season',$season);
			$tableview->setObject('season_note',$view->getSeasonStatus($season));
			$dao = &JLFactory::getDivisionDao();
			$tableview->setObject('divdao',$dao);
			$tableview->setObject('divisionlinks',$divisionlinks);
		} else {
			$tableview = new JLTemplate("lookwhoscoming");
			$regsvc = &JLRegistrationService::getInstance();
			$registrations = $regsvc->getRegisteredTeams($season->getId());
			$tableview->setObject('registrations',$registrations);
		} 
		$tableview->setObject('season',$season);		
		$tableview->setObject('season_note',$view->getSeasonStatus($season));
		$view->addTemplate($tableview);		
		$view->suppressCommonLibraries();
		$view->display();
    }
 
}

?>
