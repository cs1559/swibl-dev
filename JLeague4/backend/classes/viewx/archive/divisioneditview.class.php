<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLDivisionEditView extends JLBackendBaseView   {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		// Disable Joomla Main Menu
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Division' ), 'divisions');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=divisions');
 		JToolBarHelper::cancel( 'cancelDivision','Cancel' );	
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
		$obj = new JLDivision();
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["name"])) {
			$obj->setName($_REQUEST["name"]);
		}
		if (isset($_REQUEST["agegroup"])) {
			$obj->setAgeGroup($_REQUEST["agegroup"]);
		}
		if (isset($_REQUEST["season_id"])) {
			$obj->setSeasonId($_REQUEST["season_id"]);
		}
		if (isset($_REQUEST["league_id"])) {
			$obj->setLeagueId($_REQUEST["league_id"]);
		}		
		if (isset($_REQUEST["order"])) {
			$obj->setOrder($_REQUEST["order"]);
		}		
		if (isset($_REQUEST["published"])) {
			$obj->setPublished($_REQUEST["published"]);
		}	
		if (isset($_REQUEST["primarycontactid"])) {
			$obj->setPrimaryContactId($_REQUEST["primarycontactid"]);
		}			
		if (isset($_REQUEST["secondarycontactid"])) {
			$obj->setSecondaryContactId($_REQUEST["secondarycontactid"]);
		}				
		
		return $obj;		
	}
}

?>