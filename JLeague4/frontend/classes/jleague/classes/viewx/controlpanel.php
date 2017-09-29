<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLControlPanelView extends JLComponentBackendView  {
	
	function __construct($task=null) {
		parent::__construct($task);
	}
	
	function getTitle() {
		JToolBarHelper::title( JLText::getText( 'JLeague - Control Panel' ), 'jleague' );
	}
	
	function getDefaultToolbar() {
		JToolBarHelper::back('Back to Joomla' , 'index.php');
	}

}

?>