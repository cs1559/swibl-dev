<?php

/**
 * @version		$Id: registration.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
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
		if (isset($_REQUEST['divclass'])) {
			$obj->setDivisionClass(JLUtil::getRequestParam('divclass'));
		}					
		
		return $obj;		
	}
	function getEditToolbar() {
		//LIST - new, edit, publish, unpublish, delete
		//EDIT -- save, save & close, save & new, cancel
		
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');
		JToolBarHelper::apply();
		JToolBarHelper::save();	
		//JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=registrations');
 		JToolBarHelper::cancel( 'cancelRegistration','Cancel' );	
	}
	function getRegisterteamToolbar() {
		//LIST - new, edit, publish, unpublish, delete
		//EDIT -- save, save & close, save & new, cancel
		
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=registrations');
 		JToolBarHelper::cancel( 'cancelRegistration','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}
			
	function getDefaultToolbar() {
		//LIST - new, edit, publish, unpublish, delete
		//EDIT -- save, save & close, save & new, cancel
		
		JToolBarHelper::title( JLText::getText( 'Team Registrations' ), 'jleague');	
// 		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newregistration' , JLText::getText( 'New' ) );
		JToolBarHelper::editList();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::deleteList();
	}	


}

?>