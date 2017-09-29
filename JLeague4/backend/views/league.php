<?php

/**
 * @version		$Id: league.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

require_once('componentbackendview.php');

class JLLeagueView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle(JLText::getText("League Management"));
	}

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
		if (isset($_REQUEST["abbrname"])) {
			$league->setAbbrName($_REQUEST["abbrname"]);
		}
		if (isset($_REQUEST["description"])) {
			$league->setDescription($_REQUEST["description"]);
		}
		if (isset($_REQUEST["published"])) {
			$league->setPublished($_REQUEST["published"]);
		}		
		$keys = array_keys($_REQUEST);
	    foreach ($keys as $key) {
//	    	echo "Processing KEY = " . $key . "<br/>";
    		if (in_array($key,$league->propertykeys)) {
//    			echo " -- Adding KEY " . $key . "<br/>";
    			$league->addProperty($key,$_REQUEST[$key]);
    		}
    	}
		
		return $league;		
	}

	function getEditToolbar() {
		//LIST - new, edit, publish, unpublish, delete
		//EDIT -- save, save & close, save & new, cancel
		
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');		
//  		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=leagues');
		JToolBarHelper::apply();
		JToolBarHelper::save();	
		JToolBarHelper::cancel( 'cancelLeague','Cancel' );
	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');
// 		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newleague' , JLText::getText( 'New' ) );
		// 		JToolBarHelper::editList();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::deleteList();


	}	
	

}

?>