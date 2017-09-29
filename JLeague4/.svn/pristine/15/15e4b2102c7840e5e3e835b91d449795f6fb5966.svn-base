<?php
/**
 * @version		$Id: teamcontact.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'contact.class.php');

class JLTeamContact extends JLContact {
	
	var $userid = null;
	public static $MANAGER = 1;
	public static $COACH = 2;
	public static $OTHER = 3;
	
	var $primary = 0;
	var $teamid = null;
	
	public function __construct() {
		parent::__construct();
	}
	
	function getTeamId() {
		return $this->teamid;
	}
	function setTeamId($id) {
		$this->teamid = $id;
	}
	function getUserid() {
		return $this->userid;
	}
	function setUserid($uid) {
		$this->userid = $uid;
	}
	
	function setPrimary($flag = false) {
		$this->primary = $flag;
	}
	function isPrimary() {
		return $this->primary;
	}
	
	
}

?>