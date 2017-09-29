<?php
/**
 * @version $Id: plgstandingsmodule.class.php 283 2011-10-24 02:19:58Z Chris Strieter $ 
 * @author Chris Strieter 
 * @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved 
 * @package Maps
 * @filesource 
 * @license See license.html
*/

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'plugin.class.php');

class JLStandingsModulePlugin extends JLPlugin {

	public function __construct() {
		parent::__construct();
	}

	function init(array $context = null) {
        require_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
	}
	
	function exec(array $context=null) {
		self::init();
		extract($context);
		
		if (!isset($team)) {
			return "ERROR:  Undefined TEAM variable in plugin.";
		}
		
		if (!$team instanceof JLTeam ) {
			return "ERROR:  Team variable is not of type JLTeam";
		}
//		
//		$div = $team->getDivision();
//		if ($div == null) {
//			$content = "Standings Unavailable";
//			return $content;
//		}
		
		$standingssvc = JLStandingsService::getInstance();
		$standings = $standingssvc->getStandings(
				$team->getDivision()->getLeagueId(),
				$team->getSeason()->getId(),
				$team->getDivision()->getId());

		$season = $team->getSeason();
		$division = $team->getDivision();
		
		$content = "				
		<div id=\"teamprofile-standings\">
			<div class=\"teamprofile-sectionheader teamprofile-sectionheader-left\">
			<div class=\"teamprofile-sectionheader-right\">
				Standings
			</div>
			</div>";

		$content .= "<div id=\"teamprofile-standings-title\">" . $season->getTitle() . "-" . $division->getName() . "</div>";
		$content .= "<table>";
		$content .= "<tbody>";
		if (sizeof($standings)>0) {
			foreach ($standings as $standing) {
				$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' .$standing->getSlug() . "&Itemid=9999999" );
				$fmtrec = $standing->getWins() . "-" . $standing->getLosses() . "-" . $standing->getTies();
				$content .= "<tr><td><a href='" . $link . "'>" . $standing->getTeamName() . "</a></td><td>" . $fmtrec . "</td></tr>";		
				
			}
		} else {
			$content .= "<tr><td align='center'><br/>Divisional Assignments Pending</td></tr>";
		}
		$content .= "</tbody>";
		$content .= "</table>";
		$content .= "</div>";

		return $content;
	
	}
	
}
?>