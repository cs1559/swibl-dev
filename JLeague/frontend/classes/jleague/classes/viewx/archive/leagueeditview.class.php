<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLLeagueEditView extends JLBackendBaseView   {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		// Disable Joomla Main Menu
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=leagues');
 		JToolBarHelper::cancel( 'listleagues','Cancel' );	
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
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'league.class.php');
		$league = new JLLeague();
		if (isset($_REQUEST["id"])) {
			$league->setId($_REQUEST["id"]);
		} else {
			$league->setId(0);
		}
		if (isset($_REQUEST["name"])) {
			$league->setName($_REQUEST["name"]);
		}
		if (isset($_REQUEST["description"])) {
			$league->setDescription($_REQUEST["description"]);
		}
		if (isset($_REQUEST["published"])) {
			$league->setPublished($_REQUEST["published"]);
		}		
		return $league;		
	}
}

?>