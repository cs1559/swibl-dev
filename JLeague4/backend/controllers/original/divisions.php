<?php
/**
 * @version		$Id: divisions.php 214 2010-12-31 21:52:22Z Chris Strieter $
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

/**
 * Division Controller
 */
class JLeagueControllerDivisions extends JLeagueController
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=divisions&task=listDivision';
	var $homeUrl = 'index.php?option=com_jleague';
	
	function __construct() {
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'divisionservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getDivisionService();
		$this->setService($service);
	}
	
	/**
	 * This is the default controller function that will display a list of divisions
	 *
	 */
	function display() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisions.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		$filter = '';
		$mainframe	=& JFactory::getApplication();
		$service = &JLFactory::getDivisionService();
		
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.limitstart', 'limitstart', 0, 'int' );
		$filter_season 	= $mainframe->getUserStateFromRequest( 'com_jleague.display'.'filter_season', 'filter_season', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$total_divisions = $service->getTotalRows();
		if ($filter_season > 0) {
			$filter = ' where season = ' . $filter_season;
		}
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_divisions, $limitstart, $limit);

		try {
			$divisions = $service->getRecords($pagination->limitstart,$pagination->limit, 'ORDER BY season, sort_order', $filter);
		} catch (Exception $e) {
			$this->setRedirect($this->homeUrl,"An error occurred retrieving data from core table or related tables - " . $e->getMessage());
			return;
		}
		$view = new JLDivisionsView();
		$tmpl = new JLListTemplate("divisionlist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('filter_season',$filter_season);
		$tmpl->setObject('divisions',$divisions);
		$view->addTemplate($tmpl);
		$view->display();
	}
	
	function apply() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisions.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		$service = $this->service;
		$view = new JLDivisionsView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
			$tmpl = new JLTemplate("divisionedit");
			$tmpl->setObject('division',$obj);
			$view->addTemplate($tmpl);
			$view->display(); 	
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}		
	}

	function save() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisions.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		$service = $this->service;
		$view = new JLDivisionsView($this->_task);
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Division successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
	}
	
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisions.php');
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
		
		$otherdivs = $service->getOtherDivisions($obj->getSeasonId(),$obj->getId());
		$view = new JLDivisionsView($this->_task);
		$tmpl = new JLTemplate("divisionedit");
		$tmpl->setObject('division',$obj);
		$tmpl->setObject('otherdivs',$otherdivs);
		$view->addTemplate($tmpl);
		$view->display(); 		
	}
	
	function newdivision() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisions.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$obj = JLFactory::createDivision();
		
		$view = new JLDivisionsView("edit");
		$tmpl = new JLTemplate("divisionedit");
		$tmpl->setObject('division',$obj);
		$tmpl->setObject('otherdivs',null);
		$view->addTemplate($tmpl);
		$view->display(); 	
	}
	
}