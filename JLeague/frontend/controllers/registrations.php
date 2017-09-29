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
	
	
	class mRegistrations  extends mBaseController {
	
		function __construct() {
			parent::__construct();
		}
	
		/**
		 * This function will display the registration form and enable the user to enter the appropriate
		 * data to submit their registration.
		 *
		 */
		public function register() {
	
			
			// CHECK TO SEE IF REGISTRATION IS OPEN
			$rsvc = &JLRegistrationService::getInstance();
			$ssvc = &JLSecurityService::getInstance();
			if (!$ssvc->isAdmin()) {
				if (!$rsvc->isRegistrationOpen()) {
					echo "We are sorry ... SWIBL is currently not accepting registrations. ";
					return;
				}
			}
			
			if (isset($_REQUEST["teamid"])) {
				$teamid = $_REQUEST["teamid"];
				$tsvc = & JLTeamService::getInstance();
				$team = $tsvc->getRow($teamid);
			} else {
				$team = null;
			}
			
			$view = new mRegistrationsView(APP_TEMPLATES_PATH);
			$reg = $view->getNewRegistration($team);
			
			/*
			if (!JLSecurityService::canViewRoster($team, $seasonid)) {
				echo "You do not have permissions to view this teams roster";
				return;		
			}
			$ssvc = & JLSeasonService::getInstance();
			$season = $ssvc->getRow($seasonid);
			*/
			
			
	// 		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/registration.css');
			$tmpl = new fsTemplate("registration.selectseason");
			$tmpl->setObject('reg',$reg);
			$view->addTemplate($tmpl);
			$view->render();	
		}	
	
		/**
		 * This controller function will display the appropriate registration form for the given season.
		 */
		public function displayform() {
			$req = &fsRequest::getInstance();
			
			$teamid = $req->getValue("teamid");
			$seasonid = $req->getValue("seasonid");
			
			if ($seasonid <= 0) {
				echo "Invalid Season ID";
				return;
			}
			
			$ssvc = &JLSeasonService::getInstance();
			$season = $ssvc->getRow($seasonid);
			
			if (isset($teamid) && $teamid > 0) {
				$teamid = $req->getValue("teamid");
				$tsvc = & JLTeamService::getInstance();
				$team = $tsvc->getRow($teamid);
			} else {
				if ($season->getPropertyValue("regexistingonly")) {
					echo "<br/><br/>";
					echo "Sorry ... currently, this season is only open for registration to existing teams.  Please check back later";
					return;
				}
				$team = null;
			}
			
			if ($team != null) {
				if (!JLSecurityService::canRegisterTeam($team)) {
					echo "<br/><br/>";
					echo "ERROR:  You are not AUTHORIZED to register this team.  It appears you are attempting to register an existing team. ";
					echo "Please contact an administrator if this is incorrect";
					return;
				}
			}
			
			
			$view = new mRegistrationsView(APP_TEMPLATES_PATH);
			$reg = $view->getNewRegistration($team);
			
			$rtmpl = $season->getRegistrationTemplate();
			if (strlen(rtrim($rtmpl)) > 0) {
			} else {
				$rtmpl = "registrationform1";
			}
	
			$tmpl = new fsTemplate("registrationformwrapper");
			
			$tmpl1 = new fsTemplate($rtmpl);
			$tmpl1->setAlias("registrationinput");
			$tmpl1->setObject('reg',$reg);
			$tmpl1->setObject('seasonid',$seasonid);
			
	 		$tmpl->addTemplate($tmpl1);
			$tmpl->setObject("registrationnotes",$view->getRegistrationNotes($season));
			//		$tmpl->setObject('reg',$reg);
			//		$tmpl->setObject('seasonid',$seasonid);
			$view->addTemplate($tmpl);
			
			$view->render();
	 		
		}
		
		
		/**
		 * 
		 */
		public function ajaxGetForm() {
	
			$req = &fsRequest::getInstance();
			
			$teamid = $req->getValue("teamid");
			$seasonid = $req->getValue("seasonid");
			
			/*
			$teamid = $_REQUEST["teamid"];
			$seasonid = $_REQUEST["seasonid"];
			*/
			
			if ($seasonid <= 0) {
				echo "";
				return;
			}
	
			$ssvc = &JLSeasonService::getInstance();
			$season = $ssvc->getRow($seasonid);
		
			if (isset($teamid) && $teamid > 0) {
				$teamid = $req->getValue("teamid");
				$tsvc = & JLTeamService::getInstance();
				$team = $tsvc->getRow($teamid);
			} else {
				if ($season->getPropertyValue("regexistingonly")) {
					echo "<br/><br/>";
					echo "Sorry ... currently, this season is only open for registration to existing teams.  Please check back later";
					return;
				}
				$team = null;
			}
		
			if ($team != null) {
				if (!JLSecurityService::isAuthorizedTask($team)) {
					echo "<br/><br/>";
					echo "ERROR:  You are not AUTHORIZED to register this team.  It appears you are attempting to register an existing team. ";
					echo "Please contact an administrator if this is incorrect";
					return;
				}
			}
		
		
			$view = new mRegistrationsView(APP_TEMPLATES_PATH);
			$reg = $view->getNewRegistration($team);
	// 		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/registration.css');
		
			$rtmpl = $season->getRegistrationTemplate();
			if (strlen(rtrim($rtmpl)) > 0) {
			} else {
				$rtmpl = "registrationform1";
			}
			//$tmpl = new JLTemplate($rtmpl);
			$tmpl = new fsTemplate("registrationformwrapper");
		
			$tmpl1 = new fsTemplate($rtmpl);
			$tmpl1->setAlias("registrationinput");
			$tmpl1->setObject('reg',$reg);
			$tmpl1->setObject('seasonid',$seasonid);
		
			$tmpl->addTemplate($tmpl1);
			$tmpl->setObject("registrationnotes",$view->getRegistrationNotes($season));
			//		$tmpl->setObject('reg',$reg);
			//		$tmpl->setObject('seasonid',$seasonid);
			$view->addTemplate($tmpl);
			$view->render();
		
		}
			
		
		/**
		 * The SAVE function will save a PENDING registration that is submitted from the front-end
		 * of the system.
		 *
		 */
		public function save() {
		
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			
			$lsvc = &JLLeagueService::getInstance();
			$league = $lsvc->getRow($config->getLeagueId());
			$regsvc = &JLRegistrationService::getInstance();
			$ssvc = &JLSeasonService::getInstance();
			
			$view = new mRegistrationsView(APP_TEMPLATES_PATH);
			
			$registration = new JLTeamRegistration();
			$view->bindRequest($registration);
	
			$season = $ssvc->getRow($registration->getSeasonId());
			
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
	
			$tmpl = new fsTemplate("registrationcomplete", APP_TEMPLATES_PATH);
			$tmpl->setObject('leaguename',$league->getName());
			$tmpl->setObject('reg',$registration);
			$tmpl->setObject("seasonname",$season->getTitle());
			$tmpl->setObject('confirmation_number',$registration->getConfirmationNumber());
	
			$confirmationurl = JURI::root() . "index.php?option=com_jleague&controller=registrations&task=confirm&id=" . $registration->getId() 
				. "&confirmation=" . $registration->getConfirmationNumber();
			
			$template = $season->getRegistrationEmailTemplate();
			if (strlen($template) < 1) {
				$template = "registrationemail";
			}
	
			$emailtmpl = new fsTemplate($template, APP_TEMPLATES_PATH);
			$emailtmpl->setObject('confirmationurl',$confirmationurl);
			$emailtmpl->setObject('existingteam',$registration->getExistingTeam());
			$emailtmpl->setObject("seasonname",$season->getTitle());	
			$emailmsg = $emailtmpl->getContent();
			$emailmsg .= $tmpl->getContent();
			// Generate Confirmation / Validation email
		//	JLUtil::sendMail($fromemail,$fromname,$emails, "SWIBL - Game Score Posted", $emailmsg, true,null,"chris@swibl-baseball.org");
			JLUtil::sendMail("info@swibl-baseball.org","SWIBL",$registration->getEmail(), "SWIBL - Team Registration Confirmation", $emailmsg, true, null,"chris@swibl-baseball.org");
			
			$view->addTemplate($tmpl);
			$view->render();
			
		}
		
		
		/**
		 * The confirm function is used to validate a team's registration.  If a registration hasn't been 
		 * confirmed it should be assumed to be invalid.
		 *
		 */
		public function confirm() {
				
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			$req = &fsRequest::getInstance();
	
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
	
	?>