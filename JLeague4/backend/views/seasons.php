<?php
/**
 * @version		$Id: seasons.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
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
		if (isset($_REQUEST["publishstandings"])) {
			$obj->setPublishStandings($_REQUEST["publishstandings"]);
		}
		if (isset($_REQUEST["setupfinal"])) {
			$obj->setSetupFinal($_REQUEST["setupfinal"]);
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
		if (isset($_REQUEST["registrationonly"])) {
			$obj->setRegistrationOnly($_REQUEST["registrationonly"]);
		}		
		if (isset($_REQUEST["registrationtemplate"])) {
			$obj->setRegistrationTemplate($_REQUEST["registrationtemplate"]);
		}	
		if (isset($_REQUEST["registrationemailtemplate"])) {
			$obj->setRegistrationEmailTemplate($_REQUEST["registrationemailtemplate"]);
		}
		if (isset($_REQUEST["registrationstart"])) {
			$obj->setRegistrationStart($_REQUEST["registrationstart"]);
		}		
		if (isset($_REQUEST["registrationend"])) {
			$obj->setRegistrationEnd($_REQUEST["registrationend"]);
		}		
		if (isset($_REQUEST["registrationnotes"])) {
			$obj->setRegistrationNotes($_REQUEST["registrationnotes"]);
		}		
		
		if (isset($_REQUEST["active"])) {
			$obj->setActive($_REQUEST["active"]);
		}
		if (isset($_REQUEST["regexistingonly"])) {
			$obj->addProperty("regexistingonly",$_REQUEST["regexistingonly"]);
		}
		
		return $obj;		
	}

	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::apply();
		JToolBarHelper::save();
 		//JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=seasons');
 		JToolBarHelper::cancel( 'cancelSeasons','Cancel' );	
	}	
	
	function getDefaultToolbar() {
// 		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newseason' , JLText::getText( 'New' ) );
		JToolBarHelper::editList();
		JToolBarHelper::custom( 'closeSeason', 'copy.png', 'copy_f2.png', 'Close Season', true);
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::deleteList();
	}	
	

}

?>