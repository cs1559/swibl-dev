<?php
/**
 * @version		$Id: subscription.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLSubscription extends JLBaseObject  {

	var $id = null;
	var $userid = null;
	var $type = null;
	
    function __construct() {
    	parent::__construct();
    	$this->id = 0;
    }
    
    function setId($inParm) {
    	$this->id = $inParm;
    }
    function getId() {
    	return $this->id;
    }
    function setUserid($id) { 
    	$this->userid = $id;
    }
    function getUserid() {
    	return $this->userid;
    }
    function getType() {
    	return $this->type;
    }
    function setType($type) {
    	$this->type = $type;
    }

}
?>