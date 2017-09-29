<?php
/**
 * @version 		$Id: uploadlogo.php 52 2010-02-24 23:20:54Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');

class JLRegistrationsView extends JLFrontendBaseView {
	
	function __construct() {
		parent::__construct();
	}

	function getTeamIdValue($reg = null) {
		if ($reg == null) {
			return "New Team";
		}
		if ($reg->getTeamId() != null) {
			return $reg->getTeamId();
		} else {
			return "New Team";
		}
	}
	function getPaid($reg = null) {
		if ($reg->isPaid()) {
			return "Yes";
		} else {
			return "No";
		}
	}
	function getNewRegistration(JLTeam $team = null) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamregistration.class.php');
		$reg = new JLTeamRegistration();
		$reg->setPlayingInTournament(true);
		$reg->setExistingTeam(false);
		$reg->setPaid(false);
		$reg->setConfirmed(false);
		
		if ($team == null) {
			return $reg;
		}
		$reg->setId(0);
		$reg->setTeamId($team->getId());
		$reg->setTeamName($team->getName());
		$reg->setName($team->getCoachName());
		$reg->setCity($team->getCity());
		$reg->setState($team->getState());
		$reg->setEmail($team->getCoachEmail());
		$reg->setPhone($team->getCoachPhone());
		$reg->setExistingTeam(true);
		return $reg;
	}
	
	function bindRequest(JLTeamRegistration &$reg) {

		$req = &fsRequest::getInstance();
		
		$reg->setTeamId($req->getValue("teamid"));
		$reg->setSeasonId($req->getValue("seasonid"));
		$reg->setTeamName($req->getValue("teamname"));
		$reg->setAddress($req->getValue("address"));
		$reg->setCity($req->getValue("city"));
		$reg->setState($req->getValue("state"));
		$reg->setName($req->getValue("coachname"));
		$reg->setEmail($req->getValue("coachemail"));
		$reg->setPhone($req->getValue("coachphone"));
		$reg->setCellPhone($req->getValue("coachcellphone"));
		$reg->setAgeGroup($req->getValue("agegroup"));
		$reg->setPlayingInTournament($req->getValue("tournament"));
		$reg->setRegisteredBy($req->getValue("enteredby"));
		$reg->setPaid($req->getValue("paid"));
		$reg->setTosAck($req->getValue("tos_ack"));
		$reg->setIpAddress($req->getValue("ipaddr"));
		
		/*
		if (isset($_REQUEST['address'])) {
			$reg->setAddress(JLUtil::getRequestParam('address',''));
		}
		if (isset($_REQUEST['city'])) {
			$reg->setCity(JLUtil::getRequestParam('city',''));
		}
		if (isset($_REQUEST['state'])) {
			$reg->setState(JLUtil::getRequestParam('state',''));
		}
		if (isset($_REQUEST['coachname'])) {
			$reg->setName(JLUtil::getRequestParam('coachname'));
		}		
		if (isset($_REQUEST['coachemail'])) {
			$reg->setEmail(JLUtil::getRequestParam('coachemail'));
		}		
		if (isset($_REQUEST['coachphone'])) {
			$reg->setPhone(JLUtil::getRequestParam('coachphone'));
		}
		if (isset($_REQUEST['coachcellphone'])) {
			$reg->setCellPhone(JLUtil::getRequestParam('coachcellphone'));
		}		
		if (isset($_REQUEST['agegroup'])) {
			$reg->setAgeGroup(JLUtil::getRequestParam('agegroup'));
		}				
		if (isset($_REQUEST['tournament'])) {
			$reg->setPlayingInTournament(JLUtil::getRequestParam('tournament'));
		}				
		if (isset($_REQUEST['enteredby'])) {
			$reg->setRegisteredBy(JLUtil::getRequestParam('enteredby'));
		}				
		if (isset($_REQUEST['paid'])) {
			$reg->setPaid(JLUtil::getRequestParam('paid'));
		}
		if (isset($_REQUEST['tos_ack'])) {
			$reg->setPaid(JLUtil::getRequestParam('paid'));
		}				
		*/
		
	}
	
}

?>