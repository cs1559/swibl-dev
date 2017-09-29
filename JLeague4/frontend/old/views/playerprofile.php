<?php
/**
 * @version 		$Id: scoreboard.php 52 2010-02-24 23:20:54Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */


require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');

class JLPlayerProfileView extends JLFrontendBaseView {
	
	function __construct() {
		parent::__construct();
	}
	
	function bindRequest(JLPlayer &$player) {
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		$player->setId(JLUtil::getRequestParam('playerid','0'));
		if (isset($_REQUEST['lastname'])) {
			$player->setLastName(JLUtil::getRequestParam('lastname',''));
		}
		if (isset($_REQUEST['firstname'])) {
			$player->setFirstName(JLUtil::getRequestParam('firstname',''));
		}
		if (isset($_REQUEST['city'])) {
			$player->setCity(JLUtil::getRequestParam('city',''));
		}
		if (isset($_REQUEST['state'])) {
			$player->setState(JLUtil::getRequestParam('state',''));
		}
		
/*
		foreach ($team->getCustomFields() as $field) {
			if ($field instanceof JLField) {
				if (isset($_REQUEST[$field->getKeycode()])) {
					$field->setValue($_REQUEST[$field->getKeycode()]);
					$team->setField($field);
				}
			}
		}
*/
	}
}

?>