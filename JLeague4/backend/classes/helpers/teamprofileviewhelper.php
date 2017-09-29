<?php

/**
 * @version 		$Id: teamprofileviewhelper.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Helpers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'baseviewhelper.class.php');

class JLTeamProfileViewHelper extends JLBaseViewHelper {
	
	function getTeamContactUserIndicator($contact) {
		if (intval($contact->getUserid())>0) {
			return "<image src='" . JURI::root() . "components/com_jleague/assets/images/checkmark-small.jpg' />";
		}
		return "";
	}	
	
	function getOpponent(JLTeam $context, JLGame $game) {
		$teamid = $context->getId();
		if ($game->getAwayteamId() == $teamid) {
			return "@" . $game->getHometeam();	
		} else {
			return $game->getAwayteam();
		}
	}
	
}
?>