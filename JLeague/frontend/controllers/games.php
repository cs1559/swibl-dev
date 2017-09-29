<?php
/**
 * @version		$Id: games.php 52 2010-02-24 23:20:54Z Chris Strieter $
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
 
class mGames  extends mBaseController {
	
  
    function __construct()
    {
    	parent::__construct();
		
    } 
	
   function listupcominggames()
    {

    	$app = &mFactory::getApp();
    	$config = $app->getConfig();
    	$doc = $app->getDocument();
    	$maxresults = 50;
    	$doc->setTitle("Upcoming Games");
    	
    	$days = $config->getProperty('frontpage_upcoming_games_days');
    	$maxgames = $config->getProperty('frontpage_upcoming_games_games');
    	$season = $app->getCurrentSeason();
    	
    	$cache = & JLCache::getInstance();
    	
    	
    	$svc = &JLGamesService::getInstance();
    	$games = $svc->getUpcomingGames(150,50,true);
    	
    	echo sizeof($games);
    	
   /* 	
		$svc = & JLGamesService::getInstance();
		//$games = $svc->getMostRecentGamesForSeason();
		$games = $svc->getUpcomingGames(60,50);	
		
		$view = new JLScoreboardView();
		$tmpl = new JLTemplate("upcominggames");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('readmore','');
		$view->addTemplate($tmpl);
        $view->display();
        */
    	
    	$keyid = $season->getId();
    	try {
    		$view = $cache->get("upcoming_games",$keyid);
    		$view->display();
    	} catch (Exception $e) {
    		// 			//$filter = JLHtml::getSeasonSelectList('seasonid', $season->getId(),true,'onchange="getTeamsForSeason(this.value);"');
    	
    		$games = $svc->getUpcomingGames(60,50,true);
    		$view = new fsView(APP_TEMPLATES_PATH);
    		$tmpl = new fsTemplate("upcominggames");
    		$tmpl->setObject("games",$games);
    		$tmpl->setObject("season",$season);
    		$tmpl->setObject("config", $config);
    		$tmpl->setObject('readmore','');
    		$view->addTemplate($tmpl);
    		$view->render();
    		$cache->store("upcoming_games",$keyid,$view);
    	}
    	
    }
    
    function listgameresults()
    {
       	
    	$app = &mFactory::getApp();
    	$config = $app->getConfig();
    	$doc = $app->getDocument();
    	$maxresults = 50;
    	$doc->setTitle("Game Results");
    	
    	$svc = & JLGamesService::getInstance();
    	
    	$seasonsvc = & JLSeasonService::getInstance();
    	// Try to get the currently ACTIVE season.  If not available, then get the most
    	// recent season.
    	try {
    		$season = $seasonsvc->getMostRecentSeason();
    	} catch (Exception $e) {
    		throw $e;
    	}
    	
    	$cache = & JLCache::getInstance();
    	
    	$keyid = $season->getId();
    	try {
    		$view = $cache->get("gameResults",$keyid);
    		$view->display();
    	} catch (Exception $e) {
    		// 			//$filter = JLHtml::getSeasonSelectList('seasonid', $season->getId(),true,'onchange="getTeamsForSeason(this.value);"');

    		$games = $svc->getMostRecentGamesForSeason($season->getId(),$maxresults);    		
    		$view = new fsView(APP_TEMPLATES_PATH);
    		$tmpl = new fsTemplate("gameresults");
    		$tmpl->setObject("games",$games);
    		$tmpl->setObject("season",$season);
    		$tmpl->setObject("config", $config);
    		$view->addTemplate($tmpl);
    		$view->render();
    		$cache->store("gameResults",$keyid,$view);
    	}
    	 
    	 
    	/*
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
    	 
    	$svc = & JLGamesService::getInstance();
    	//$games = $svc->getMostRecentGamesForSeason();
    	$games = $svc->getUpcomingGames(60,50);
    
    	$view = new JLScoreboardView();
    	$tmpl = new JLTemplate("upcominggames");
    	$tmpl->setObject('games',$games);
    	$tmpl->setObject('readmore','');
    	$view->addTemplate($tmpl);
    	$view->display();
    	*/
    }
    
}

?>
