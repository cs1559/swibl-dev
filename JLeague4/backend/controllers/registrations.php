<?php
/**
 * @version		$Id: registrations.php 298 2011-11-20 13:00:20Z Chris Strieter $
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
class JLeagueControllerRegistrations extends JLeagueControllerAdmin
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=registrations';
	
	function __construct() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'registration.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'teamservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getRegistrationService();
		$this->setService($service);
		// Set REDIRECT Configurations
		$this->setFunctionRedirect("togglePublish",$this->redirectUrl);
	}
	
	function display() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'util.php');
		
		$filter = '';
		$app	= JLApplication::getMainframe();
		$service = $this->getService();
		
		// Get the pagination request variables
		$limit		= $app->getUserStateFromRequest( 'global.list.limit', 'limit', $app->getCfg('list_limit'), 'int' );
		$limitstart	= $app->getUserStateFromRequest( 'com_jleague.standings.limitstart', 'limitstart', 0, 'int' );
		$filter_season 	= $app->getUserStateFromRequest( 'com_jleague.registrations.display'.'filter_season', 'filter_season', 0, 'int');
		$filter_divisionid 	= $app->getUserStateFromRequest( 'com_jleague.registrations.display'.'filter_divisionid', 'filter_divisionid', 0, 'int');
		
		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		
		if ($filter_season > 0) {
			$filter = ' where season = ' . $filter_season;
		} 
		if ($filter_divisionid > 0 && $filter_season > 0) {
			$filter .= ' and division_id = ' . $filter_divisionid;
		}
			
		$total_registrations = $service->getTotalRows($filter);
		echo "Registrations = " . $total_registrations;
		
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_registrations, $limitstart, $limit);
				
		$registrations = $service->getRecords($pagination->limitstart,$pagination->limit, '  ORDER BY season, agegroup, teamname ', $filter);

		$view = new JLRegistrationView();
		$tmpl = new JLListTemplate("registrationlist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('filter_season',$filter_season);
		$tmpl->setObject('filter_divisionid',$filter_divisionid);
		$tmpl->setObject('registrations',$registrations);
		$view->addTemplate($tmpl);
		$view->display();
	}
	

	function apply() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		$svc = JLFactory::getRegistrationService();
		$view = new JLRegistrationView($this->_task);
		$obj = $view->bindRequestToObject();
 		$rc = $svc->save($obj);
 		if ($rc) {
 			$season = $svc->getRegistrationSeason();
 			$teams = $svc->getUnregisteredTeams($season->getId());
 			$tmpl = new JLTemplate("registrationedit");
 			$tmpl->setObject('registration',$obj);
 			$tmpl->setObject('season',$season);
//  			$tmpl->setObject('teams',$teams);
 			$view->addTemplate($tmpl);
 			$view->display();
 		} else {
 			JError::raiseError( 500, "Operation failed (save)");
 		}

	}

	
	/**
	 * This function will SAVE the team registration 
	 *
	 */
	function save() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');

		$service = & JLRegistrationService::getInstance();
		$view = new JLRegistrationView($this->_task);
		$obj = $view->bindRequestToObject();
		
		$rc = $service->save($obj);		
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Registration saved  successfully ... ");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
		$this->redirect();
	}
	
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'registration.php');		
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
		
		$svc = JLFactory::getRegistrationService();
		$season = $svc->getRegistrationSeason();
// 		$teams = $svc->getUnregisteredTeams($season->getId());
		$view = new JLRegistrationView($this->_task);
		$tmpl = new JLTemplate("registrationedit");
		$tmpl->setObject('registration',$obj);
		$tmpl->setObject('season',$season);
// 		$tmpl->setObject('teams',$teams);
		$view->addTemplate($tmpl);
		$view->display(); 	
	}
	
	function newregistration() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'registration.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'teamregistration.class.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		
		$view = new JLRegistrationView("edit");
		$svc = JLFactory::getRegistrationService();
		$obj = $view->bindRequestToObject();
		
		if (!$svc->isRegistrationOpen()) {
			$this->setRedirect($this->redirectUrl,JLText::getText('JL_REGISTRATION_NOT_AVAILABLE'));
			return;
		}
		$season = $svc->getRegistrationSeason();		
		
		$teams = $svc->getUnregisteredTeams($season->getId());
		$tmpl = new JLTemplate("registrationedit");
		$tmpl->setObject('registration',$obj);
		$tmpl->setObject('season',$season);
		$tmpl->setObject('teams',$teams);
		$view->addScript(JURI::root() . 'administrator/components/com_jleague/js/jquery.transfer.js');
		$view->addTemplate($tmpl);
		$view->display();
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
	
	function cancelRegistration()
	{
		$this->setRedirect($this->redirectUrl,"Operation Cancelled");
		$this->redirect();
	}
	
	
	
}