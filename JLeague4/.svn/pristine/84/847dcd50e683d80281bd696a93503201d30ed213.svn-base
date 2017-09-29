<?php
/**
 * @version		$Id: games.php 186 2010-12-26 12:08:20Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controller
 * @copyright 	(C) 2008,2011 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

class JLeagueControllerGames extends JLeagueController
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=games&task=listGames';
	
	function __construct()
	{
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'gamesservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getGamesService();
		$this->setService($service);		
	}
	
	/**
	 * This funciton will display a list of all of the games logged in the website.
	 *
	 */
	function display() {
		
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'games.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		
		$mainframe	=& JFactory::getApplication();
		$service = $this->getService();
		
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.limitstart', 'limitstart', 0, 'int' );
		$filter_season 	= $mainframe->getUserStateFromRequest( 'com_jleague.games.display'.'filter_season', 'filter_season', 0, 'int');		
		
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$filter = array();
		if ($filter_season > 0) {
			$filter[] = 'season = ' . $filter_season;
		}
		$total_rows = $service->getTotalRows($filter);
				
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_rows, $limitstart, $limit);

		$rows = $service->getRecords($pagination->limitstart,$pagination->limit,'ORDER BY GAME_DATE DESC ',$filter);
		
		$view = new JLGamesView();
		$tmpl = new JLListTemplate("gameslist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('filter_season',$filter_season);
		$tmpl->setObject('total_rows',$total_rows);
		$tmpl->setObject('rows',$rows);
		$view->addTemplate($tmpl);
		$view->display();
	}

	/**
	 * This function will present the user an EDIT screen 
	 *
	 */
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'games.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'gameviewhelper.php');
		$service = $this->getService();
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		
		$game = $service->getRow($cid[0]);
		$viewhelper = new JLGameViewHelper($game);
		
		$view = new JLGamesView($this->_task);
		$tmpl = new JLTemplate("gameedit");
		$tmpl->setObject('helper',$viewhelper);
		$tmpl->setObject('game',$game);
		$view->addTemplate($tmpl);
		$view->display(); 
	}	
	
	function save() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'games.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		$service = & JLGamesService::getInstance();
		$view = new JLGamesView($this->_task);
		$obj = $view->bindRequestToObject();
		try {
			$rc = $service->save($obj);
			$msg = "Game successfully updated";
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
		$this->setRedirect($this->redirectUrl,$msg);
	}

	function newgame() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'games.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'gameviewhelper.php');
		$obj = JLFactory::createGame();
		$viewhelper = new JLGameViewHelper($obj);
		$view = new JLGamesView("edit");
		$tmpl = new JLTemplate("gameedit");
		$tmpl->setObject('game',$obj);
		$tmpl->setObject('helper',$viewhelper);
		$view->addTemplate($tmpl);
		$view->display(); 	
	}	
}