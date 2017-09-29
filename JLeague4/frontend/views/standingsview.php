<?php

defined('_APPEXEC') or die('Restricted access');

class mStandingsView extends mBaseView {
	
	/**
	 * Helper function that translates the season status to a brief sentence related to 
	 * the season's status
	 * 
	 * @param JLSeason $season
	 * @return string
	 */
	function getSeasonStatus(JLSeason $season) {
		if ($season->getStatus() == "C") {
			return "NOTE:  This season has been COMPLETED.";
		}
		if ($season->getStatus() == "P") {
			return "NOTE:  This season is PENDING - League divisions being finalized";
		}
		if ($season->isSetupFinal()) {
			return "NOTE:  This season is currently active";
		} else {
			return "NOTE:  This season is active but setup and division assignments are TENTATIVE";
		}
	}
	
	function getWebsiteUrl(JLTeamView $team) {
		$teamobj = $team->getTeam();
		if (strlen($teamobj->getWebsite())>0) {
			return new fsLink($teamobj->getWebsite(),"Click Here");
		} else {
			return "Not Available";
		}
	}
	
	function getUSSSAProfileUrl(JLTeamView $team) {
		$app = &mFactory::getApp();
		$teamobj = $team->getTeam();
		$config = &mConfig::getInstance();
		$url = $config->getProperty('sanctioning_body_team_url') . $teamobj->getFieldValue("FLD_USSSA_NUMBER");
		if (_APPDEBUG) {
			$app->writeDebug("USSSA URL=" . $url);
		}
		if (strlen($teamobj->getFieldValue("FLD_USSSA_NUMBER"))>0) {
			return new fsLink($url,$teamobj->getFieldValue("FLD_USSSA_NUMBER"));
		} else {
			return "Not Available";
		}
	}
}