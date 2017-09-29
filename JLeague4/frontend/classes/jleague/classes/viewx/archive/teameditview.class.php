<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLTeamEditView extends JLBackendBaseView   {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		// Disable Joomla Main Menu
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team' ), 'teams');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=teams');
 		JToolBarHelper::cancel( 'cancel','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();
	}

	/**
	 * The bindRequestToObject function binds the request object associated with the view to the 
	 * object 
	 *
	 * @return unknown
	 */
	function bindRequestToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'division.class.php');
		$obj = new JLTeam();
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["name"])) {
			$obj->setName($_REQUEST["name"]);
		}
		if (isset($_REQUEST["website"])) {
			$obj->setWebsite($_REQUEST["website"]);
		}
		if (isset($_REQUEST["city"])) {
			$obj->setCity($_REQUEST["city"]);
		}
		if (isset($_REQUEST["state"])) {
			$obj->setState($_REQUEST["state"]);
		}		
//		if (isset($_REQUEST["order"])) {
//			$obj->setOrder($_REQUEST["order"]);
//		}		
//		if (isset($_REQUEST["published"])) {
//			$obj->setPublished($_REQUEST["published"]);
//		}		
		return $obj;		
	}
}

?>