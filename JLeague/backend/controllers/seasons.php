<?php
/**
 * @version		$Id: seasons.php 186 2010-12-26 12:08:20Z Chris Strieter $
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
class JLeagueControllerSeasons extends JLeagueControllerAdmin
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=seasons';
	
	function __construct() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasons.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'factory.php');
		parent::__construct();
		$service = &JLFactory::getSeasonService();
		$this->setRedirectURL($this->redirectUrl);
		$this->setService($service);
		$this->setFunctionRedirect("togglePublish",$this->redirectUrl);		
	}
	
	function display() {
		$mainframe	=& JFactory::getApplication();
		$service = &JLFactory::getSeasonService();
		
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.limitstart', 'limitstart', 0, 'int' );
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$total_seasons = $service->getTotalRows();
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_seasons, $limitstart, $limit);
		
		$seasons = $service->getRecords($pagination->limitstart,$pagination->limit,'ORDER BY TITLE');

		$total_seasons = $service->getTotalRows();
		
		$view = new JLSeasonsView();
		$tmpl = new JLListTemplate("seasonslist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('seasons',$seasons);
		$view->addTemplate($tmpl);
		$view->display();
	}
	
	function apply() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasons.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$service = $this->service;
		$view = new JLSeasonsView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
			$obj = $service->getRow($obj->getId());
			$tmpl = new JLTemplate("seasonedit");
			$tmpl->setObject('season',$obj);
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
		$view = new JLSeasonsView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Season successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}		
		$this->redirect();
	}
	
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasons.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$service = $this->getService();
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		$obj = $service->getRow($cid[0]);
		
		$view = new JLSeasonsView($this->_task);
		$tmpl = new JLTemplate("seasonedit");
		$tmpl->setObject('season',$obj);
		$view->addTemplate($tmpl);
		$view->display(); 			
	}
	
	function newseason() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasons.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$obj = JLFactory::createSeason();
		$view = new JLSeasonsView("edit");
		$tmpl = new JLTemplate("seasonedit");
		$tmpl->setObject('season',$obj);
		$view->addTemplate($tmpl);
		$view->display();
	}
	
	/**
	 * This function performs the activities need to close out the season. 
	 *
	 */
	function closeSeason() {
		$seasonsvc = &JLSeasonService::getInstance();
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
//		$cid	= array((int) $cid[0]);

		$season = null;
		$seasonid = $cid[0];
		try {
			$season = $seasonsvc->getRow($seasonid);
			if (!$season->getActive()) {
				$this->setRedirect($this->redirectUrl,"You are unable to close this season.  It is not ACTIVE");
			}
			$seasonsvc->closeSeason($season);			
		} catch (Exception $e) {
			 $this->setRedirect($this->redirectUrl,$e->getMessage());
			 return;
		}
		
		$this->setRedirect($this->redirectUrl,"Season has been closed successfully");
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
	
	function cancel()
	{
		$this->setRedirect("index.php?option=com_jleague","Operation Cancelled");
		parent::cancel();
		$this->redirect();
	}
	
	function cancelSeasons()
	{
		$this->setRedirect("index.php?option=com_jleague&controller=seasons","Operation Cancelled");
		$this->redirect();
	}
	
	function remove() {
		$this->setRedirectURL($this->redirectUrl);
		parent::remove();
		$this->redirect();
	}
	

}