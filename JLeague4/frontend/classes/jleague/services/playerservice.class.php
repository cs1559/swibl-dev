<?php

/**
 * @version		$Id: playerservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'player.class.php');

class JLPlayerService  extends JLBaseService  {

	protected function __construct() {
		parent::__construct();
	}
	
	function save($obj) {
		
	 	if (!parent::save($obj)) {
			throw new Exception("Error saving player");
		}
		return true;
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLPlayerService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLFactory::getPlayerDao();
		return $dao;
	}

	public function getAllPlayers() {
		$dao = & JLFactory::getPlayerDao();
		return $dao->getRows();
	}
	
	public function getUnassignedPlayers($season) {
		$dao = & JLFactory::getPlayerDao();
		return $dao->getUnassignedPlayers($season);
		
	}
	
	public function getPlayer($playerid) {
		$dao = $this->getDao();
		return $dao->findById($playerid);
	}
}

?>