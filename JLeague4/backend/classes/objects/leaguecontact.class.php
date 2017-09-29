<?php

/**
 * @version		$Id: leaguecontact.class.php 390 2012-02-12 12:06:45Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'contact.class.php');

class JLLeagueContact extends JLContact {
	
	
	function __construct() {
		parent::__construct();		
	}
	
	
}
?>