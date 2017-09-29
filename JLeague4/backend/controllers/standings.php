<?php
/**
 * @version		$Id: standings.php 186 2010-12-26 12:08:20Z Chris Strieter $
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
 * Jom Social Component Controller
 */
class JLeagueControllerStandings extends JLeagueControllerAdmin
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=standings';
	var $listview = 'StandingsListView';
	var $editview = 'StandingsEditView';
	var $listtemplate = 'standingslist';
	var $edittemplate = 'standingsedit';
	
	function __construct() {
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'standingsservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getStandingsService();
		$this->setService($service);
		// Set REDIRECT Configurations
		$this->setFunctionRedirect("togglePublish",$this->redirectUrl);
	}
	
	function display() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'standingslistview.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');		
		$filter = array();
		$mainframe	=& JFactory::getApplication();
		$service = $this->getService();
		
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.standings.limitstart', 'limitstart', 0, 'int' );
		$filter_league 	= $mainframe->getUserStateFromRequest( 'com_jleague.standings.display'.'filter_league', 'filter_league', 0, 'int');		
		$filter_season 	= $mainframe->getUserStateFromRequest( 'com_jleague.standings.display'.'filter_season', 'filter_season', 0, 'int');
		$filter_divisionid 	= $mainframe->getUserStateFromRequest( 'com_jleague.standings.display'.'filter_divisionid', 'filter_divisionid', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		if ($filter_league > 0) {
			$filter[] = "league_id = " . $filter_league;
		}
		if ($filter_season > 0) {
			$filter[] = "t.season = " . $filter_season;
		}
		if ($filter_divisionid > 0) {
			$filter[] =  "division_id = ". $filter_divisionid;
		}
			
		$totalrows = $service->getTotalRows($filter);
		
		jimport('joomla.html.pagination');
		$pagination = new JPagination($totalrows, $limitstart, $limit);
				
		$rows = $service->getRecords($pagination->limitstart,$pagination->limit, '', $filter);
		
		$view = new JLStandingsListView();
		$tmpl = new JLListTemplate("standingslist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('standings',$rows);
		$tmpl->setObject('filter_league',$filter_league);		
		$tmpl->setObject('filter_season',$filter_season);
		$tmpl->setObject('filter_divisionid',$filter_divisionid);		
		$view->addTemplate($tmpl);
		$view->display();
		
	}
	
	function apply() {
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
		$service = $this->service;
		$view = JLViewFactory::getView($this->editview);
		$obj = $view->bindRequestToObject();
		var_dump($obj);
//		echo "here I am";
//		exit;
		
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Division successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
	}
	
	function edit() {
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
		$view->setObject('team',$obj);
		$view->setTemplate($this->edittemplate);
		$view->display();
	}
	

}