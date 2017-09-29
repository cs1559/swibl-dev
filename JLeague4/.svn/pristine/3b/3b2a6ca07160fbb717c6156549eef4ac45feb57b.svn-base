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
 
jimport('joomla.application.component.controller');
 
class JLeagueControllerGames extends JController
{
	
	function display()
    {
        parent::display();
    }
    
    function __construct()
    {
    	parent::__construct();
		
    } 
	
   function listupcominggames()
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
    			
		$svc = & JLGamesService::getInstance();
		//$games = $svc->getMostRecentGamesForSeason();
		$games = $svc->getUpcomingGames(60,50);	
		
		$view = new JLScoreboardView();
		$tmpl = new JLTemplate("upcominggames");
		$tmpl->setObject('games',$games);
		$tmpl->setObject('readmore','');
		$view->addTemplate($tmpl);
        $view->display();
    }
    
}

?>
