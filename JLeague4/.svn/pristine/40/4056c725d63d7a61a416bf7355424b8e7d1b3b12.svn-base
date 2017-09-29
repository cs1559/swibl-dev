<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'backendview.class.php');

class JLComponentBackendView extends JLBackendBaseView {
	
	function __construct($task=null) {
		parent::__construct($task);
	}
	
	function getSubmenu() {
		$active = 'jleague';
		JSubMenuHelper::addEntry( 'Home' , 'index.php?option=com_jleague&view=jleague' , $active );
		JSubMenuHelper::addEntry( 'Configuration' , 'index.php?option=com_jleague&view=configure' , $active );
		JSubMenuHelper::addEntry( 'Leagues' , 'index.php?option=com_jleague&controller=leagues' , $active );	
		JSubMenuHelper::addEntry( 'Seasons' , 'index.php?option=com_jleague&controller=seasons' , $active );
		JSubMenuHelper::addEntry( 'Divisions' , 'index.php?option=com_jleague&controller=divisions' , $active );
		JSubMenuHelper::addEntry( 'Teams' , 'index.php?option=com_jleague&controller=teams' , $active );
		JSubMenuHelper::addEntry( 'Registrations' , 'index.php?option=com_jleague&controller=registrations' , $active );		
		JSubMenuHelper::addEntry( 'Games' , 'index.php?option=com_jleague&controller=games' , $active );
		JSubMenuHelper::addEntry( 'Standings' , 'index.php?option=com_jleague&controller=standings' , $active );
		JSubMenuHelper::addEntry( 'Sponsors' , 'index.php?option=com_jleague&controller=sponsors' , $active );			
	}

}

?>