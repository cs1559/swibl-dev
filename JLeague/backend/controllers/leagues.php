<?php
/**
 * @version		$Id: leagues.php 186 2010-12-26 12:08:20Z Chris Strieter $
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

require_once (JLEAGUE_CONTROLLERS  . DS . 'admincontroller.php');
/**
 * JLeague - Leagues Controller
 */
class JLeagueControllerLeagues extends JLeagueControllerAdmin
{
	private $model = null;
	var $redirectUrl = 'index.php?option=com_jleague&controller=leagues';
	
	function __construct() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'league.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'factory.php');		
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'leagueservice.class.php');
		parent::__construct();
		$service = &JLFactory::getLeagueService();
		$this->setService($service);
		// Set REDIRECT Configurations
		$this->setFunctionRedirect("togglePublish",$this->redirectUrl);
	}
	
// 	function execute() {
// 		$mainframe	=& JFactory::getApplication();
// 		$service = $this->getService();
		
// 		// Get the pagination request variables
// 		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
// 		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.limitstart', 'limitstart', 0, 'int' );
// 		// In case limit has been changed, adjust limitstart accordingly
// 		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

// 		$total_leagues = $service->getTotalRows();
		
// 		jimport('joomla.html.pagination');
// 		$pagination = new JPagination($total_leagues, $limitstart, $limit);
				
// 		$leagues = $service->getRecords($pagination->limitstart,$pagination->limit,'ORDER BY NAME');

// 		$total_leagues = $service->getTotalRows();

// 		$view = new JLLeagueView();
// 		$tmpl = new JLListTemplate("leaguelist");
// 		$tmpl->setPagination($pagination);
// 		$tmpl->setObject('leagues',$leagues);
// 		$view->addTemplate($tmpl);
// 		$view->display();
// 	}
	
	
	function display() {
		$mainframe	=& JFactory::getApplication();
		$service = $this->getService();
	
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.limitstart', 'limitstart', 0, 'int' );
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
	
		$total_leagues = $service->getTotalRows();
	
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_leagues, $limitstart, $limit);
	
		$leagues = $service->getRecords($pagination->limitstart,$pagination->limit,'ORDER BY NAME');
	
		$total_leagues = $service->getTotalRows();
	
		$view = new JLLeagueView();
		$tmpl = new JLListTemplate("leaguelist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('leagues',$leagues);
		$view->addTemplate($tmpl);
		$view->display();
	}
		
	function apply() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'league.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$service = $this->service;
		$view = new JLLeagueView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
			$obj = $service->getRow($obj->getId());
			$tmpl = new JLTemplate("leagueedit");
			$tmpl->setObject('league',$obj);
			$view->addTemplate($tmpl);
			$view->display(); 	
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}	
				
	}

	function save() {
		
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasons.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		$service = $this->service;
		$view = new JLLeagueView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"League successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}		
		$this->redirect();
				
	}
	
	/**
	 * This function will allow one to EDIT a given row 
	 */
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'league.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$service = $this->getService();
		if ($this->getTask() == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		$obj = $service->getRow($cid[0]);
		$view = new JLLeagueView($this->getTask());
		$tmpl = new JLTemplate("leagueedit");
		$tmpl->setObject('league',$obj);
		$view->addTemplate($tmpl);
		$view->display(); 					
	}

	function newleague() {
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'factory.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$league = JLFactory::createLeague();
		$view = new JLLeagueView("edit");
		$tmpl = new JLTemplate("leagueedit");
		$tmpl->setObject('league',$league);
		$view->addTemplate($tmpl);
		$view->display(); 
	}
	
	
	function cancel()
	{
		$this->setRedirect("index.php?option=com_jleague","Operation Cancelled");
		parent::cancel();
		$this->redirect();
	}
	
	function cancelLeague()
	{
		$this->setRedirect("index.php?option=com_jleague&controller=leagues","Operation Cancelled");
		$this->redirect();
	}
	
	
	
	function remove() {
		$this->setRedirectURL($this->redirectUrl);
		parent::remove();
		$this->redirect();
	}
	
	function togglePublish() {
		$this->setRedirectURL($this->redirectUrl);
		parent::togglePublish();
		$this->redirect();
	}
	
	/**
	 * This function will publish the selected rows
	 *
	 */
	function publish() {
		$this->setRedirectURL($this->redirectUrl);
		parent::publish();
		$this->redirect();
	}
	
	/**
	 * This function will unpublish the selected rows.
	 *
	 */
	function unpublish() {
		$this->setRedirectURL($this->redirectUrl);
		parent::unpublish();
		$this->redirect();
	}
	


	
}