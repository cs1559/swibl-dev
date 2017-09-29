<?php 
/**
 * @version		$Id: userpreferences.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLUserPreferences extends JLBaseObject {
	
	private $uid = 0;
	private $uname = "";
	
    function __construct() {
    	parent::__construct();
    	$this->uid = 0;
    }
    
    function setId($id) {
    	$this->uid = $id;
    }
    function getId() {
    	return $this->uid;
    }
    function setUserName($name) {
    	$this->uname = $name;
    }
    function getUserName() {
    	return $this->uname;
    }

}

?>