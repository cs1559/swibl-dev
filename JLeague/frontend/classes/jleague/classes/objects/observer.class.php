<?php

/**
 * @version		$Id: observer.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The JLObserverIF is an interface class for any Observer object.
 */

interface JLObserverIF {
	
	//public function notify();
	public function notify($event, &$args);

}

?>