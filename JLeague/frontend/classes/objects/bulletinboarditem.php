<?php
/**
 * @version		$Id: season.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLBulletinBoardItem extends JLBulletin  {

	var $teamname = null;
	var $teamlogo = null;
	
	function __construct() {
    	parent::__construct();
    }
    
    function setTeamName($name) {
    	$this->teamname = $name;
    }
    function getTeamName() {
    	return $this->teamname;
    }
    function setTeamLogo($logo) {
    	$this->teamlogo = $logo;
    }
    function getTeamLogo() {
    	return $this->teamlogo;
    }
    
	
}
?>