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

class JLeagueControllerRosters  extends JLeagueController {

	function __construct() {
		parent::__construct();
	}

	public function printRoster() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'simplerosterservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'seasonservice.class.php');
		require_once(JLEAGUE_VIEWS_PATH . DS . 'printroster.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');

		if (isset($_REQUEST["teamid"])) {
			$teamid = $_REQUEST["teamid"];
		} else {
			echo "No team id specified";
			return;
		}
		if (isset($_REQUEST["season"])) {
			$seasonid = $_REQUEST["season"];
		} else {
			echo "No season specified";
			return;
		}
		
		$tsvc = & JLTeamService::getInstance();
		$team = $tsvc->getRow($teamid);
		
		if (!JLSecurityService::canViewRoster($team, $seasonid)) {
			echo "You do not have permissions to view this teams roster";
			return;		
		}
		$ssvc = & JLSeasonService::getInstance();
		$season = $ssvc->getRow($seasonid);
		$rsvc = & JLSimpleRosterService::getInstance();
		$roster = $rsvc->getRoster($teamid,$seasonid);
		
		$view = new JLPrintRosterView();
		$view->addStylesheet(JURI::root() . 'components/com_jleague/css/print.css');
		$tmpl = new JLTemplate("printroster");
		$tmpl->setObject('team',$team);
		$tmpl->setObject('season',$season);
		$tmpl->setObject('roster',$roster);
		$view->addTemplate($tmpl);
		$view->display();

	}	
}