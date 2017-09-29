<?php
/**
 * @version 		$Id: standings.php 161 2010-12-20 20:44:43Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');

class JLContactsView extends JLFrontendBaseView {
	
	function __construct() {
		parent::__construct();
		self::setTitle("SWIBL Team Contacts");
	}

}

?>