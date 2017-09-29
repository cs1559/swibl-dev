<?php
/**
 * @version 		$Id: registrations.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

defined('_APPEXEC') or die('Restricted access');

class mRegistrationsView extends mBaseView {


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
		$reg = new JLTeamRegistration();
		$reg->setTeamId(0);
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
		$reg->setPlayingInAllStarEvent($req->getValue("allstarevent"));
		$reg->setRegisteredBy($req->getValue("enteredby"));
		$reg->setPaid($req->getValue("paid"));
		$reg->setTosAck($req->getValue("tos_ack"));
		$reg->setRequestedClassification($req->getValue("requestedclass"));
		$reg->setDivisionClass($req->getValue("divisionclass"));
		$reg->setIpAddress($req->getValue("ipaddr"));			
		if ($req->getValue("tos_ack") == "on") {
			$reg->setTosAck(true);
		} else {
			$reg->setTosAck(false);
		}
	}
	
	function getRegistrationNotes(JLSeason $season) {
		$notes = $season->getRegistrationNotes();
		if ($notes == "") {
			return null;
		}
		$html = "<p><strong>NOTES ABOUT THE: " . $season->getTitle() . " season:</strong>" . $notes . "</p>";
		return $html;
	}
}

?>