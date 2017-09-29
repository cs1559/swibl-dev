<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLLeagueView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
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
		if (isset($_REQUEST["description"])) {
			$league->setDescription($_REQUEST["description"]);
		}
		if (isset($_REQUEST["published"])) {
			$league->setPublished($_REQUEST["published"]);
		}		
		return $league;		
	}

	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=leagues');
 		JToolBarHelper::cancel( 'cancelLeague','Cancel' );	
 		JToolBarHelper::divider();
 		JToolBarHelper::apply();
		JToolBarHelper::save();	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'League' ), 'leagues');
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
//		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newleague' , JLText::getText( 'New' ) );
	}	
	

}

?>