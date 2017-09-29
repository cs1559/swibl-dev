<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLRegistrationView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle( JLText::getText( 'Team Registrations' ));		
	}
	
	function getPaid($reg = null) {
		if ($reg->isPaid()) {
			return "Yes";
		} else {
			return "No";
		}
	}

	function getConfirmed($reg = null) {
		if ($reg->isConfirmed()) {
			return "Yes";
		} else {
			return "No";
		}
	}
	
	function bindRequestToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'teamregistration.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'util.php');
		$obj = new JLTeamRegistration();
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["teamid"])) {
			$obj->setTeamId($_REQUEST["teamid"]);
		}		
		if (isset($_REQUEST["seasonid"])) {
			$obj->setSeasonId($_REQUEST["seasonid"]);
		}	
		if (isset($_REQUEST["divisionid"])) {
			$obj->setDivisionId($_REQUEST["divisionid"]);
		}			
		if (isset($_REQUEST["contactname"])) {
			$obj->setName($_REQUEST["contactname"]);
		}
		if (isset($_REQUEST["address"])) {
			$obj->setAddress($_REQUEST["address"]);
		}
		if (isset($_REQUEST["city"])) {
			$obj->setCity($_REQUEST["city"]);
		}
		if (isset($_REQUEST["state"])) {
			$obj->setState($_REQUEST["state"]);
		}	
		if (isset($_REQUEST["contactname"])) {
			$obj->setName($_REQUEST["contactname"]);
		}
		if (isset($_REQUEST["contactemail"])) {
			$obj->setEmail($_REQUEST["contactemail"]);
		}
		if (isset($_REQUEST["contactphone"])) {
			$obj->setPhone($_REQUEST["contactphone"]);
		}
		if (isset($_REQUEST["contactcellphone"])) {
			$obj->setCellPhone($_REQUEST["contactcellphone"]);
		}		
		if (isset($_REQUEST["agegroup"])) {
			$obj->setAgeGroup($_REQUEST["agegroup"]);
		}
		if (isset($_REQUEST["email"])) {
			$obj->setEmail($_REQUEST["email"]);
		}
		if (isset($_REQUEST["teamname"])) {
			$obj->setTeamName($_REQUEST["teamname"]);
		}		
		if (isset($_REQUEST["returning_team"])) {
			$obj->setExistingTeam($_REQUEST["returning_team"]);
		}		
		if (isset($_REQUEST["published"])) {
			$obj->setPublished($_REQUEST["published"]);
		}		
		if (isset($_REQUEST['tournament'])) {
			$obj->setPlayingInTournament(JLUtil::getRequestParam('tournament'));
		}				
		if (isset($_REQUEST['enteredby'])) {
			$obj->setRegisteredBy(JLUtil::getRequestParam('enteredby'));
		}				
		if (isset($_REQUEST['paid'])) {
			$obj->setPaid(JLUtil::getRequestParam('paid'));
		}				
		
		return $obj;		
	}
	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=registrations');
 		JToolBarHelper::cancel( 'cancelRegistration','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}	

	function getRegisterteamToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=registrations');
 		JToolBarHelper::cancel( 'cancelRegistration','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}
			
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');	
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
//		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
//		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
//		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newregistration' , JLText::getText( 'New' ) );
//		JToolBarHelper::addNew( 'newregistration' , JLText::getText( 'New' ) );
	}	


}

?>