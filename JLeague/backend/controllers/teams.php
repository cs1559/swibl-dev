	<?php
/**
 * @version		$Id: teams.php 298 2011-11-20 13:00:20Z Chris Strieter $
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
 * JLeague Teams Controller
 */
class JLeagueControllerTeams extends JLeagueControllerAdmin
{
	var $redirectUrl = 'index.php?option=com_jleague&controller=teams';
	
	function __construct() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'teamservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		
		parent::__construct();
		$service = &JLFactory::getTeamService();
		$this->setService($service);
		// Set REDIRECT Configurations
		$this->setFunctionRedirect("togglePublish",$this->redirectUrl);
	}
	
	function display() {
		include(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'listtemplate.class.php');
		
		$filter = '';
		$mainframe	=& JFactory::getApplication();
		$service = $this->getService();

		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( 'com_jleague.teams.limitstart', 'limitstart', 0, 'int' );
		$filter_season 	= $mainframe->getUserStateFromRequest( 'com_jleague.teams.display'.'filter_season', 'filter_season', 0, 'int');
		$filter_divisionid 	= $mainframe->getUserStateFromRequest( 'com_jleague.teams.display'.'filter_divisionid', 'filter_divisionid', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		if ($filter_season > 0) {
			$filter = ' where season = ' . $filter_season;
		} 
		if ($filter_divisionid > 0) {
			$filter .= ' and division_id = ' . $filter_divisionid;
		}
			
		$total_teams = $service->getTotalRows($filter);
		
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total_teams, $limitstart, $limit);
				
		$teams = $service->getRecords($pagination->limitstart,$pagination->limit, 'ORDER BY name', $filter);

		$view = new JLTeamsView($this->_task);
		$tmpl = new JLListTemplate("teamlist");
		$tmpl->setPagination($pagination);
		$tmpl->setObject('filter_season',$filter_season);
		$tmpl->setObject('filter_divisionid',$filter_divisionid);
		$tmpl->setObject('teams',$teams);
		$view->addTemplate($tmpl);
		$view->display();
	}
	
	function apply() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		$service = $this->service;
		$view = new JLTeamsView($this->_task);		
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
			$tmpl = new JLTemplate("teamedit");
			$tmpl->setObject('team',$obj);
			$view->addTemplate($tmpl);
			$view->display(); 	
		} else {
			JError::raiseError( 500, "Operation failed (apply)");
		}
	}

	function registerTeam() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
		$cid	= array((int) $cid[0]);
		$service = $this->service;
		
		$svc = JLFactory::getRegistrationService();
		if (!$svc->isRegistrationOpen()) {
			$this->setRedirect($this->redirectUrl,JLText::getText('JL_REGISTRATION_NOT_AVAILABLE'));
			return;
		}
		$season = $svc->getRegistrationSeason();

		$team = $service->getRow($cid[0]);
			
		$view = new JLTeamsView("registerteam");
		$view->setTitle("Register Team");
		$tmpl = new JLTemplate("registerteam");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('season',$season);
		$view->addTemplate($tmpl);
		$view->display(); 	
		
	}
	
	function save() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
		$service = $this->service;
		$view = new JLTeamsView($this->_task);				
		$service = $this->service;
		$obj = $view->bindRequestToObject();
		$rc = $service->save($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,"Team successfully updated");
		} else {
			JError::raiseError( 500, "Operation failed (save)");
		}
	}
	
	function edit() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
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

		$contacts = $service->getTeamContacts($cid[0]);
		
		$view = new JLTeamsView($this->_task);
		$tmpl = new JLTemplate("teamedit");
		$tmpl->setObject('team',$obj);
		$tmpl->setObject('contacts',$contacts);
		$tmpl2 = new JLTemplate("currentcontactstable");
		$tmpl2->setObject('contacts',$contacts);
		$tmpl->setObject('currentcontactstable',$tmpl2->getContent());
		$view->addTemplate($tmpl);
		$view->display(); 	
	}
	
	function newteam() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$obj = JLFactory::createTeam();
		$contacts = array();
		$view = new JLTeamsView("edit");
		$tmpl = new JLTemplate("teamedit");
		$tmpl->setObject('team',$obj);
		$tmpl->setObject('contacts',$contacts);
		$tmpl2 = new JLTemplate("currentcontactstable");
		$tmpl2->setObject('contacts',$contacts);
		$tmpl->setObject('currentcontactstable',$tmpl2->getContent());
		$view->addTemplate($tmpl);
		$view->display();
	}
	
	function saveRegistration() {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teams.php');		
		$service = JLFactory::getRegistrationService();
		$view = new JLTeamsView();				
		$obj = $view->bindRegistrationToObject();
		if (!is_object($obj)) {
			$this->setRedirect($this->redirectUrl,JLText::getText('JL_FORM_COULDNOT_BIND'));
		}
		$rc = $service->registerTeam($obj);
		if ($rc) {
			$this->setRedirect($this->redirectUrl,JLText::getText('JL_TEAM_REGISTRATION_SUCCESSFUL'));
		} else {
			JError::raiseError( 500, "Operation failed (saveRegistration)");
		}
	}
	
	function ajaxRemoveTeamContact() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
		$service = $this->getService();
		$contactid = null;
		$teamid = null;
		if (isset($_REQUEST["id"])) {
			$contactid = $_REQUEST["id"];
		}
		if (!$service->removeTeamContact($contactid)) {
			echo "ERROR:  Removal Team Contact failed";
			return;
		}
		if (isset($_REQUEST["teamid"])) {
			$teamid = $_REQUEST["teamid"];
		} 
		$contacts = $service->getTeamContacts($teamid);
		$tmpl = new JLTemplate("currentcontactstable");
		$tmpl->setObject('contacts',$contacts);
		$html = $tmpl->getContent();
		echo $html;
	}
	
	function ajaxAddTeamContact() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');	
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'teamcontact.class.php');
		
		if (!isset($_REQUEST["teamid"])) {
			echo "ERROR:  Missing TEAM ID value";
			return;
		}
		
		$service = $this->getService();
		$teamid = $_REQUEST["teamid"];
		$contact = new JLTeamContact();
		$contact->setId(0);
		$contact->setTeamId($teamid);
		$contact->setName($_REQUEST["contactname"]);
		$contact->setPhone($_REQUEST["contactphone"]);
		$contact->setEmail($_REQUEST["contactemail"]);
		$contact->setRole($_REQUEST["role"]);
		if (!$service->addTeamContact($contact)) {
			echo "ERROR:  Add Team Contact failed";
			return;
		}
		$contacts = $service->getTeamContacts($teamid);
		$tmpl = new JLTemplate("currentcontactstable");
		$tmpl->setObject('contacts',$contacts);
		$html = $tmpl->getContent();
		echo $html;
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
	
	function cancelTeams()
	{
		$this->setRedirect($this->redirectUrl,"Operation Cancelled");
		$this->redirect();
	}
	
}