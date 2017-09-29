<?php
/**
 * @version 		$Id: standings.php 161 2010-12-20 20:44:43Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');

class JLAdminDashboardView extends JLFrontendBaseView {
	
	function __construct() {
		parent::__construct();
		self::setTitle("SWIBL Administrative Dashboard");
	}
	
	function getSeasonStatus(JLSeason $season) {
		if ($season->getStatus() == "C") {
			return "NOTE:  This season has been COMPLETED.";
		}
		if ($season->getStatus() == "P") {
			return "NOTE:  This season is PENDING - League divisions being finalized";
		} 
		return "";
	}
	function getDivisionLinks($divisions) {
		return "";
		
		//var_dump($divisions);
		if (count($divisions) == 0) {
			return "";
		}
		$links = array();
		foreach ($divisions as $division) {
			$links[] = "<a href='" . $_SERVER['REQUEST_URI'] . "#divid-" . $division->getId() . "'>" . $division->getName() . "</a>";
		}
		return implode("|",$links);
	}
}

?>