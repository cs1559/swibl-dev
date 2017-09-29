<?php
/**
 * @version		$Id: players.php 102 2010-03-28 11:45:02Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controllers
 * @copyright 	(C) 2008,2009 Chris Strieter
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 *
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

class JLeagueControllerRegistrations  extends JLeagueController {

	function __construct() {
		parent::__construct();
	}

	/**
	 * This function will display the registration form and enable the user to enter the appropriate
	 * data to submit their registration.
	 *
	 */
	public function register() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'registrationservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_VIEWS_PATH . DS . 'registrations.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');

		// CHECK TO SEE IF REGISTRATION IS OPEN
		
		if (isset($_REQUEST["teamid"])) {
			$teamid = $_REQUEST["teamid"];
			$tsvc = & JLTeamService::getInstance();
			$team = $tsvc->getRow($teamid);
		} else {
			$team = null;
		}
		
		$view = new JLRegistrationsView();
		$reg = $view->getNewRegistration($team);
		
		/*
		if (!JLSecurityService::canViewRoster($team, $seasonid)) {
			echo "You do not have permissions to view this teams roster";
			return;		
		}
		$ssvc = & JLSeasonService::getInstance();
		$season = $ssvc->getRow($seasonid);
		*/
		
		
		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/registration.css');
		$tmpl = new JLTemplate("registrationform");
		$tmpl->setObject('reg',$reg);
		$view->addTemplate($tmpl);
		$view->display();
	}	
	
	/**
	 * The SAVE function will save a PENDING registration that is submitted from the front-end
	 * of the system.
	 *
	 */
	public function save() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'registrations.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamregistration.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS. 'leagueservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS. 'registrationservice.class.php');
		
		$config = &JLConfig::getInstance();
		
		$lsvc = &JLLeagueService::getInstance();
		$league = $lsvc->getRow($config->getLeagueId());
		$regsvc = &JLRegistrationService::getInstance();
		
		$view = new JLRegistrationsView();
		
		$registration = new JLTeamRegistration();
		$view->bindRequest($registration);

//		if ($regsvc->isTeamRegistered($registration->getTeamId(),$registration->getSeasonId())) {
//			echo "ERROR:  The " . $registration->getTeamName() . " team is already registered.";
//			return;
//		}
		
		if ($registration->getTeamId() > 0) {
			if ($regsvc->isTeamRegistered($registration->getTeamId(),$registration->getSeasonId())) {
				echo "ERROR:  The " . $registration->getTeamName() . " team is already registered.";
				return;
			}			
			$registration->setExistingTeam(true);
		} else {
			$registration->setExistingTeam(false);
		}
		
		$registration->setConfirmationNumber(JLUtil::getConfirmation());
		
		$regsvc->savePendingRegistration($registration);

		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/registration.css');
		$tmpl = new JLTemplate("registrationcomplete");
		$tmpl->setObject('leaguename',$league->getName());
		$tmpl->setObject('reg',$registration);
		$tmpl->setObject('confirmation_number',$registration->getConfirmationNumber());

		$confirmationurl = JURI::root() . "index.php?option=com_jleague&controller=registrations&task=confirm&id=" . $registration->getId() 
			. "&confirmation=" . $registration->getConfirmationNumber();

		$emailtmpl = new JLTemplate("registrationemail");
		$emailtmpl->setObject('confirmationurl',$confirmationurl);
		$emailtmpl->setObject('existingteam',$registration->getExistingTeam());
		$emailmsg = $emailtmpl->getContent();
		$emailmsg .= $tmpl->getContent();
		// Generate Confirmation / Validation email
		JLUtil::sendMail("chris@swibl-baseball.org","SWIBL",$registration->getEmail(), "SWIBL - Team Registration Confirmation", $emailmsg, true, "info@swibl-baseball.org","chris@swibl-baseball.org");
		
		$view->addTemplate($tmpl);
		$view->display();
		
	}
	
	
	/**
	 * The confirm function is used to validate a team's registration.  If a registration hasn't been 
	 * confirmed it should be assumed to be invalid.
	 *
	 */
	public function confirm() {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'registrationservice.class.php');

		$svc = & JLRegistrationService::getInstance();
		if (isset($_REQUEST["id"])) {
			$regid = $_REQUEST["id"];
		} else {
			echo "*** MISSING REGISTRATION ID";
			return;
		}
		if (isset($_REQUEST["confirmation"])) {
			$confirmation = $_REQUEST["confirmation"];
		} else {
			echo "*** MISSING CONFIRMATION NUMBER";
			return;
		}

		try {
		$registration = $svc->getRow($regid);
		} catch (Exception $e) {
			echo "ERROR:  Registration Confirmation - " . $e->getMessage();
			return;
		}
		if ($confirmation != $registration->getConfirmationNumber()) {
			echo "**** INCORRECT CONFIRMATION NUMBER ****";
			return;
		}
		$registration->setConfirmed(true);
		$svc->update($registration);
		echo "THANK YOU.  Your registration has been confirmed";		 
	}
	
}