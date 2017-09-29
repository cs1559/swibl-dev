<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once( 'componentbackendview.php');

class JLDivisionsView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle(JLText::getText("Division Management"));
	}

	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=divisions');
 		JToolBarHelper::cancel( 'cancelDivision','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newdivision' , JLText::getText( 'New' ) );
	}	

	
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
		if (isset($_REQUEST["divisionid"])) {
			$obj->setDivisionId($_REQUEST["divisionid"]);
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
		
		if (isset($_REQUEST["otherdivisions"])) {
			$divarray = $_REQUEST["otherdivisions"];
			foreach ($divarray as $key => $value) {
				$odiv = new JLDivision();
				$odiv->setId($value);
				$odiv->setName(" dummy rec for key only ");
				$obj->addDivisionInConferencePlay($odiv);
			}
		}	
		return $obj;		
	}	

	
}

?>
