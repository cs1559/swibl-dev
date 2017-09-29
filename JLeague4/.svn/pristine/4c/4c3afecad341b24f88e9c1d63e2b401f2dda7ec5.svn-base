<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLSeasonsView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle(JLText::getText("Season Management"));
	}

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
		if (isset($_REQUEST["status"])) {
			$obj->setStatus($_REQUEST["status"]);
		}
		if (isset($_REQUEST["registrationopen"])) {
			$obj->setRegistrationOpen($_REQUEST["registrationopen"]);
		}				
		return $obj;		
	}

	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=seasons');
 		JToolBarHelper::cancel( 'cancelSeasons','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
		JToolBarHelper::custom( 'closeSeason', 'copy.png', 'copy_f2.png', 'Close Season', true);
		JToolBarHelper::divider();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newseason' , JLText::getText( 'New' ) );
	}	
	

}

?>