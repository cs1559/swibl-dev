<?php
/**
 * @version		$Id: controlpanel.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'componentbackendview.php');

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