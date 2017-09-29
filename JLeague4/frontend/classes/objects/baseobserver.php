<?php

/**
 * @version		$Id: baseobserver.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

/* updated 07/12/17 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The JLObserverIF is an interface class for any Observer object.
 */

class JLBaseObserver implements JLObserverIF {
	
	var $namespace = 'JLFollowTeamObserver';
	
	public function __construct() {
		
	}
	
	public function notify($event, &$args) {
		if (method_exists(get_class($this),$event)) {
			return call_user_func(get_class($this). "::" . $event, $args);
		}
		return;
	}
	

	static public function onPostScore($args) {
		//echo "onPostScore event triggered";
		
		// Send Email to all Follow Me users
		
	}
	
}

?>