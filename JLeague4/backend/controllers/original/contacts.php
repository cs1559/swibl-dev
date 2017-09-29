<?php
/**
 * @version		$Id: contacts.php 186 2010-12-26 12:08:20Z Chris Strieter $
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
class JLeagueControllerContacts extends JLeagueController
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=divisions&task=listContacts';
	var $listview = 'ContactsListView';
	var $editview = 'ContactEditView';
	var $listtemplate = 'contactslist';
	var $edittemplate = 'contactedit';
	
	function __construct() {
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'divisionservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getDivisionService();
		$this->setService($service);
	}
	
	function display() {
		echo "contacts.php -- display";
		return;
		
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
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
				
		$divisions = $service->getRecords($pagination->limitstart,$pagination->limit, 'ORDER BY name', $filter);
				
		$view = JLViewFactory::getView('DivisionsListView');
		$view->setLimit($limit);
		$view->setLimitStart($limitstart);
		$view->setTotal($total_divisions);
		$view->setObject('divisions',$divisions);
		$view->setObject('filter_season',$filter_season);
				
		$view->setTemplate('divisionlist');
		$view->display();
	}
	
	function apply() {
		echo "contacts.php -- apply";
		return;
		
		$service = $this->service;
		$view = JLViewFactory::getView($this->editview);
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
			$view = JLViewFactory::getView($this->editview);
			$view->setObject('division',$obj);
			$view->setTemplate('divisionedit');
			$view->display();
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
	}

	function save() {
		echo "contacts.php -- save";
		return;
		
		$service = $this->service;
		$view = JLViewFactory::getView($this->editview);
		$obj = $view->bindRequestToObject();
		
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Division successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
	}
	
	function edit() {
		echo "contacts.php -- edit";
		return;
		
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$service = $this->getService();
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}
		$obj = $service->getRow($cid[0]);
		
		$view = JLViewFactory::getView($this->editview);
		$view->setObject('division',$obj);
		$view->setTemplate($this->edittemplate);
		$view->display();
	}
	
	function create() {
		echo "contacts.php -- create";
		return;
		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'factory.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$obj = JLFactory::createDivision();
		$view = JLViewFactory::getView($this->editview);
		$view->setObject('division',$obj);
		$view->setTemplate($this->edittemplate);
		$view->display();
	}
	

	
}