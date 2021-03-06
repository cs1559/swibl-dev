<?php
/**
 * @version		$Id: eventdispatcher.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'observable.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'gameobserver.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'followteamobserver.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamobserver.class.php');

class JLEventDispatcher extends JLObservable {
	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * Enter description here...
	 *
	 * @return JLEventDispatcher
	 */
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLEventDispatcher();
			$instance->attach(new JLGameObserver());
			$instance->attach(new JLFollowTeamObserver());
			$instance->attach(new JLTeamObserver());
		}
		return $instance;
	}		
	
	/*
	function trigger($event,$args = null) {
		return null;
		$method = "_" . $_REQUEST["task"];
		if (method_exists('JLEventDispatcher',$method)) {
			$cmd = '$val = JLEventDispatcher::'.$method . '($args);';
			eval( $cmd );
			return $val;
		}
		return false;
	}
	*/
	

}

?>