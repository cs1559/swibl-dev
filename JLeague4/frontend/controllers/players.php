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

class JLeagueControllerPlayers  extends JLeagueController {

	function __construct() {
		parent::__construct();
	}

	function editPlayerProfile() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'playerservice.class.php');
		require_once(JLEAGUE_VIEWS_PATH . DS . 'playerprofile.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');

		
		$playerid = $_REQUEST["playerid"];
		$ref = getenv("HTTP_REFERER");
		 
		$svc = & JLPlayerService::getInstance();
		$player = $svc->getPlayer($playerid);

		$view = new JLPlayerProfileView();
		$tmpl = new JLTemplate('player.edit');
		$tmpl->setObject('returnurl',$ref);
		$tmpl->setObject('player',$player);
		$view->addTemplate($tmpl);
		$view->display();
	}

	function doUpdate() {
		require_once(JLEAGUE_VIEWS_PATH . DS . 'playerprofile.php');
		require_once(JLEAGUE_SERVICES_PATH . DS . 'playerservice.class.php');
		
		$playerid = $this->getParam('playerid');
		$returnurl = $this->getParam('returnurl');

        // get team service
		$svc = & JLPlayerService::getInstance();
		$player = $svc->getPlayer($playerid);
		
		$view = new JLPlayerProfileView();
		$view->bindRequest($player);
				
		try {
			$svc->save($player);
		} catch (Exception $e) {
			JLApplication::redirect($returnurl, $e->getMessage());	
		}
		JLApplication::redirect($returnurl);		
	}
	
	function getAvailablePlayers() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'playerservice.class.php');
		$svc = & JLPlayerService::getInstance();
		$players = $svc->getAllPlayers();
		$result = array();
		foreach ($players as $player) {
			array_push($result,array(
				"id" => $player->getId(),
				"player" => json_encode($player)
			));
		}
		echo json_encode($result);
	}

}