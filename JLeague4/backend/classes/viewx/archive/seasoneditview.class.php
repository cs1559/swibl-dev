<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLSeasonEditView extends JLBackendBaseView   {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		// Disable Joomla Main Menu
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Season' ), 'seasons');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=seasons');
 		JToolBarHelper::cancel( 'listseasons','Cancel' );	
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
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'season.class.php');
		$obj = new JLSeason();
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["title"])) {
			$obj->setTitle($_REQUEST["title"]);
		}
		if (isset($_REQUEST["description"])) {
			$obj->setDescription($_REQUEST["description"]);
		}
		if (isset($_REQUEST["published"])) {
			$obj->setPublished($_REQUEST["published"]);
		}		
		return $obj;		
	}
}

?>