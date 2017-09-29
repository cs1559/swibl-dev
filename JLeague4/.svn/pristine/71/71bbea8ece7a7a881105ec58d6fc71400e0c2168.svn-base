<?php
/**
 * @version		$Id: teams.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */
require_once('componentbackendview.php');

class JLTeamsView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle(JLText::getText("Team Management"));
	}

	function bindRequestToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'team.class.php');
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
		if (isset($_REQUEST["coachname"])) {
			$obj->setCoachName($_REQUEST["coachname"]);
		}
		if (isset($_REQUEST["coachemail"])) {
			$obj->setCoachEmail($_REQUEST["coachemail"]);
		}
		if (isset($_REQUEST["coachphone"])) {
			$obj->setCoachPhone($_REQUEST["coachphone"]);
		}
		if (isset($_REQUEST["ownerid"])) {
			$obj->setOwnerId($_REQUEST["ownerid"]);
		}						
		return $obj;		
	}
	
	function bindRegistrationToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'teamregistration.class.php');
		$reg = new JLTeamRegistration();
		if (isset($_REQUEST["id"])) {
			$reg->setId($_REQUEST["id"]);
		} else {
			$reg->setId(0);
		}
		if (isset($_REQUEST["division_id"])) {
			$reg->setDivisionId($_REQUEST["division_id"]);
		} else {
			return false;
		}
		if (isset($_REQUEST["season_id"])) {
			$reg->setSeasonId($_REQUEST["season_id"]);
		} else {
			return false;
		}
		if (isset($_REQUEST["team_id"])) {
			$reg->setTeamId($_REQUEST["team_id"]);
		} else {
			return false;
		}
		if (isset($_REQUEST["published"])) {
			$reg->setPublished($_REQUEST["published"]);
		}
		return $reg;
	}
	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
//  		JToolBarHelper::back('Close' , 'index.php?option=com_jleague&controller=teams');
		JToolBarHelper::apply();
 		JToolBarHelper::save();
 		JToolBarHelper::cancel( 'cancelTeams','Cancel' );	
	}	
	
	function getRegisterteamToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');		
//  		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague&controller=registrations');
 		JToolBarHelper::cancel( 'cancelTeams','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save('saveRegistration','Save');	
	}
				
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');
// 		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newteam' , JLText::getText( 'New' ) );
		JToolBarHelper::editList();
// 		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
// 		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::deleteList();
		
// 		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
// 		JToolBarHelper::divider();
// 	//	JToolBarHelper::custom( 'registerTeam', 'copy.png', 'copy_f2.png', 'Register' );
// 	//	JToolBarHelper::divider();
// 	//	JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
// 	//	JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
// 	//	JToolBarHelper::divider();
// 		JToolBarHelper::deleteList();
// // 		JToolBarHelper::editListX();
// 		JToolBarHelper::addNew( 'newteam' , JLText::getText( 'New' ) );
	}	
	
}

?>